# Lab Resource Management API

REST API for managing lab resources including hosts, devices, and ports.

## Setup

1. **Install dependencies:**
```bash
pip install -r requirements.txt
```

2. **Create the database:**
```bash
mysql -u your_username -p
CREATE DATABASE lab_resources;
USE lab_resources;
source Dbs/create_tables.sql
```

3. **Update database configuration:**
Edit `apps/config.py` or update the `DB_CONFIG` in `apps/api.py` with your MySQL credentials:
```python
DB_CONFIG = {
    "host": "localhost",
    "database": "lab_resources",
    "user": "your_username",
    "password": "your_password"
}
```

4. **Run the API:**
```bash
python apps/api.py
```

Or with uvicorn directly:
```bash
uvicorn apps.api:app --reload --host 0.0.0.0 --port 8000
```

## API Documentation

Once running, access the interactive API documentation at:
- Swagger UI: http://localhost:8000/docs
- ReDoc: http://localhost:8000/redoc

## API Endpoints

### Hosts
- `GET /hosts` - Get all hosts
- `GET /hosts/{host_id}` - Get specific host
- `POST /hosts` - Create new host
- `PUT /hosts/{host_id}` - Update host
- `DELETE /hosts/{host_id}` - Delete host

### ASICs
- `GET /asics` - Get all ASIC types
- `GET /asics/{asic_id}` - Get specific ASIC type
- `POST /asics` - Create new ASIC type
- `PUT /asics/{asic_id}` - Update ASIC type
- `DELETE /asics/{asic_id}` - Delete ASIC type

### Devices
- `GET /devices` - Get all devices
- `GET /devices/{device_id}` - Get specific device
- `POST /devices` - Create new device
- `PUT /devices/{device_id}` - Update device
- `DELETE /devices/{device_id}` - Delete device

### Ports
- `GET /ports` - Get all ports
- `GET /ports/{port_id}` - Get specific port
- `POST /ports` - Create new port
- `PUT /ports/{port_id}` - Update port
- `DELETE /ports/{port_id}` - Delete port

### Relationship Endpoints
- `GET /hosts/{host_id}/devices-and-ports` - Get all devices and their ports for a specific host
- `GET /hosts/{host_id}/connected-hosts` - Get all hosts connected to the given host via port connections

### Reservation Endpoints
- `POST /hosts/{host_id}/reserve?user={username}` - Reserve a host for a specific user
- `POST /hosts/{host_id}/free?user={username}` - Free a previously reserved host

### IP Management Endpoints
- `GET /hosts/{host_id}/ip-info` - Get management and BMC IP addresses for a host
- `PUT /hosts/{host_id}/ip-info` - Update management and BMC IP addresses for a host
- `GET /devices/{device_id}/ip-info` - Get management IP, console IP and console port for a device
- `PUT /devices/{device_id}/ip-info` - Update management IP, console IP and console port for a device

## Example Usage

### Create a Host
```bash
curl -X POST "http://localhost:8000/hosts" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "server01",
    "status": "up",
    "updated_by": "admin"
  }'
```

### Get All Hosts
```bash
curl -X GET "http://localhost:8000/hosts"
```

### Update a Host
```bash
curl -X PUT "http://localhost:8000/hosts/1" \
  -H "Content-Type: application/json" \
  -d '{
    "status": "down",
    "updated_by": "admin"
  }'
```

### Create an ASIC Type
```bash
curl -X POST "http://localhost:8000/asics" \
  -H "Content-Type: application/json" \
  -d '{
    "asic_type": "Broadcom BCM56990",
    "updated_by": "admin"
  }'
```

Response example:
```json
{
  "id": 1,
  "asic_type": "Broadcom BCM56990",
  "updated_by": "admin",
  "updated_on": "2026-02-18T10:00:00"
}
```

### Create a Device
```bash
curl -X POST "http://localhost:8000/devices" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "eth0",
    "type": "nic",
    "asic": 1,
    "present_on": 1,
    "updated_by": "admin"
  }'
```

**Note:** The `asic` field now references the ASIC table ID. First create an ASIC type, then reference its ID when creating a device.

### Create a Port
```bash
curl -X POST "http://localhost:8000/ports" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "port1",
    "present_on": 1,
    "updated_by": "admin"
  }'
```

### Get Host with Devices and Ports
```bash
curl -X GET "http://localhost:8000/hosts/1/devices-and-ports"
```

Response example:
```json
{
  "host": {
    "id": 1,
    "name": "server01",
    "status": "up",
    "updated_by": "admin",
    "updated_on": "2026-02-18T10:30:00"
  },
  "devices": [
    {
      "id": 1,
      "name": "eth0",
      "type": "nic",
      "present_on": 1,
      "ports": [
        {
          "id": 1,
          "name": "port1",
          "connected": 2,
          "present_on": 1
        }
      ]
    }
  ]
}
```

### Get Connected Hosts
```bash
curl -X GET "http://localhost:8000/hosts/1/connected-hosts"
```

Response example:
```json
{
  "host": {
    "id": 1,
    "name": "server01",
    "status": "up"
  },
  "connected_hosts": [
    {
      "id": 2,
      "name": "server02",
      "status": "up"
    }
  ],
  "count": 1
}
```

### Reserve a Host
```bash
curl -X POST "http://localhost:8000/hosts/1/reserve?user=john_doe"
```

Response example:
```json
{
  "id": 1,
  "name": "server01",
  "status": "up",
  "updated_by": "john_doe",
  "updated_on": "2026-02-18T11:15:00",
  "present_used_by": "john_doe",
  "reserved_at": "2026-02-18T11:15:00"
}
```

### Free a Reserved Host
```bash
curl -X POST "http://localhost:8000/hosts/1/free?user=john_doe"
```

Response example:
```json
{
  "id": 1,
  "name": "server01",
  "status": "up",
  "updated_by": "john_doe",
  "updated_on": "2026-02-18T12:30:00",
  "present_used_by": null,
  "reserved_at": null
}
```

### Get Host IP Information
```bash
curl -X GET "http://localhost:8000/hosts/1/ip-info"
```

Response example:
```json
{
  "id": 1,
  "name": "server01",
  "mgmt_ip": "192.168.1.100",
  "bmc_ip": "192.168.2.100"
}
```

### Update Host IP Information
```bash
curl -X PUT "http://localhost:8000/hosts/1/ip-info" \
  -H "Content-Type: application/json" \
  -d '{
    "mgmt_ip": "192.168.1.101",
    "bmc_ip": "192.168.2.101",
    "updated_by": "admin"
  }'
```

### Get Device IP Information
```bash
curl -X GET "http://localhost:8000/devices/1/ip-info"
```

Response example:
```json
{
  "id": 1,
  "name": "eth0",
  "mgmt_ip": "10.0.0.50",
  "console_ip": "10.0.1.50",
  "console_port": 2001
}
```

### Update Device IP Information
```bash
curl -X PUT "http://localhost:8000/devices/1/ip-info" \
  -H "Content-Type: application/json" \
  -d '{
    "mgmt_ip": "10.0.0.51",
    "console_ip": "10.0.1.51",
    "console_port": 2002,
    "updated_by": "admin"
  }'
```

## Health Check

Check API and database health:
```bash
curl -X GET "http://localhost:8000/health"
```

## Web Interface

The project includes a web-based frontend for visualizing network topology:

### Features:
- **Landing Page** (`webs/index.html`): Displays all hosts with their status, reservation info, and filters
- **Topology Viewer** (`webs/topology.html`): Interactive network topology visualization showing:
  - Hosts, devices, and ports in a hierarchical layout
  - Port connections between devices
  - Connected hosts
  - Device details (including ASIC information)

### Setup:
1. **Enable CORS in the API** (required for web frontend):

   Update `apps/api.py` to add CORS middleware:
   ```python
   from fastapi.middleware.cors import CORSMiddleware

   app.add_middleware(
       CORSMiddleware,
       allow_origins=["*"],
       allow_credentials=True,
       allow_methods=["*"],
       allow_headers=["*"],
   )
   ```

2. **Open the web interface**:
   - Simply open `webs/index.html` in your web browser
   - Or use a local server:
     ```bash
     cd webs
     python -m http.server 8080
     ```
   - Then navigate to `http://localhost:8080`

3. **Make sure the API is running** on `http://localhost:8000`

### Usage:
- The landing page shows all hosts with status indicators (up, down, removed)
- Click on any host card to view its network topology
- The topology view shows:
  - Hierarchical visualization of host → devices → ports
  - Port connections (red dashed lines)
  - Device information including ASIC details
  - List of connected hosts
- Click on any node in the topology to see detailed information
