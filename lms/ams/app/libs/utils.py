def makeJSONGetResponse(data, totalCount):
    response = dict()
    if isinstance(data, list):
        response['body'] = data
        response['itemCount'] = len(data)
    else:
        response['body'] = [data, ]
        response['itemCount'] = 1
    response['totalCount'] = totalCount
    return response


def makeJSONInsertResponse(result, message, dataField, dataValue):
    insertResponse = dict()
    insertResponse["message"] = message
    insertResponse["status"] = result
    insertResponse["data"] = dict()
    if isinstance(dataField, list) and isinstance(dataValue, list):
        insertResponse["data"] = dict(zip(dataField, dataValue))
    else:
        if dataField is not None:
            insertResponse["data"][dataField] = dataValue
    return insertResponse
