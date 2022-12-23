<script>
    async function ajaxCallRequest(url, type, data = {}) {
        let ajax_result;
        await $.ajax({
            url: url,
            type: type,
            data: data,
            success: function (res) {
                ajax_result = res;
            },
            error: function (jqXHR) {
                let errorRes = JSON.parse(jqXHR.responseText);
                ajax_result = {status: jqXHR.status, message: errorRes.message, errorData: errorRes.errors};
            }
        });
        return ajax_result;
    }
</script>