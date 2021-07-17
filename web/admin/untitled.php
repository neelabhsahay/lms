<script src= '../asserts/js/libs/jquery.min.js'></script>
<script src= '../asserts/js/libs/core.js'></script>
<script src= "../asserts/js/libs/yearpicker.js"></script>
<script src= "../asserts/js/cookie.js" > </script>
<script>
    $(document).ready(function () {
        $(".yearpicker").yearpicker({
          startYear: new Date().getFullYear() - 50,
          endYear: new Date().getFullYear() + 10,
        });
        loadListLeaveStatus();
    });
</script>