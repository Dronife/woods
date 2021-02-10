function checkDelete(urli) {
    $('button').click(function () {


        if ($(this).attr('id') == "deleteButton") {
            var index = $(this).attr('name');

            $('#confirmDelete').attr('name', index)
        }

        if ($(this).attr('id') == "confirmDelete") {
            var index = $(this).attr('name');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: urli + index,
                type: 'delete',
                data: {
                    'id': index,
                    // "_token": token,
                },
                success: function (data) {
                    console.log(data);
                    location.reload();


                },
                error: function (data) {
                    console.log(data);
                    console.log("did not delete");
                }


            });
        }
    });
}