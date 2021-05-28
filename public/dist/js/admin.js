 $(document).ready(function() {


            $("#search").on("keyup", function() {

                var value = $(this).val().toLowerCase();
                $("#myTable #mainTable:not(:first-child)").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });




            $("input:radio[name='type'], input:radio[name='age']").click(function() {
                var valueType = $("input:radio[name='type']:checked").val().toLowerCase();
                var valueAge = $("input:radio[name='age']:checked").val().toLowerCase();
                // alert(valueType);
                // alert(valueType);
                // .not(":first")
                $('#myTable #mainTable').each(function() {
                    var type = $(this).find("td:nth-child(2)").text().toLowerCase();
                    var age = $(this).find("td:nth-child(3)").text().toLowerCase();
                    //  alert(type);
                    $(this).show();

                    if (valueType != type || valueAge != age) {
                        $(this).hide();
                    }

                    if (valueType == "all" || valueAge == "all") {
                        $(this).show();
                        if (valueType != type && valueAge != age) {
                            $(this).hide();
                        }
                    }
                    if (valueType == "all" && valueAge == "all") {
                        $(this).show();
                    }



                });
            });



            $('button').click(function() {

                if ($(this).attr('id') == "cancleFilter") {
                    $('#myTable #mainTable').each(function() {
                        $(this).show();
                    });
                    $("input[name='type'][value='All']").prop("checked", true);
                    $("input[name='age'][value='All']").prop("checked", true);
                }


                var index = $(this).attr('name');
                console.log(index);
                if ($(this).attr('id') == "editButton") {
                    $.ajax({
                        url: "forest/get/submited/{id}",
                        type: 'GET',
                        data: {
                            'id': index,
                        },
                        success: function(data) {
                            $("#userid").val(index);
                            $("#surname").val(data.surname);
                            $("#lastname").val(data.lastname);
                            $("#phone").val(data.phone);
                            $("#email").val(data.email);
                            $("#area").val(data.area);
                            $("#price").val(data.price);
                            $('#type option[value='+data.typeid+']').attr('selected','selected');
                            $('#age option[value='+data.ageid+']').attr('selected','selected');

                        },
                        error: function() {
                            $("#title").html("Nepaejo seneliumbai");
                        }

                    });
                }
               

                if ($(this).attr('id') == "exitSearch") {
                    $('#search').val('');
                    var value = $(this).val().toLowerCase();
                    $("#myTable #mainTable:not(:first-child)").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                }

               

            });
        });