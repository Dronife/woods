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
                        url: "getsubmitedForest/{id}",
                        type: 'GET',
                        data: {
                            'id': index,
                        },
                        success: function(data) {
                            $("#userid").val(index);
                            $("#lastname").val(data.lastname);
                            $("#phone").val(data.phone);
                            $("#email").val(data.email);
                            $("#area").val(data.area);
                            $("#price").val(data.price);
                            $('[name=type] option').filter(function() {
                                return ($(this).text() == data.typeid); //To select Blue
                            }).prop('selected', true);
                            $('[name=age] option').filter(function() {
                                return ($(this).text() == data.ageid); //To select Blue
                            }).prop('selected', true);
                        },
                        error: function() {
                            $("#title").html("Nepaejo seneliumbai");
                        }

                    });
                }
                if ($(this).attr('id') == "deleteButton") {
                    $('#myTable #mainTable').not(":first").each(function() {});
                }

                if ($(this).attr('id') == "exitSearch") {
                    $('#search').val('');
                    var value = $(this).val().toLowerCase();
                    $("#myTable #mainTable:not(:first-child)").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                }

                if ($(this).attr('id') == "confirmDelete") {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "deleteSubmittion/" + index,
                        type: 'delete',
                        data: {
                            'id': index,
                            // "_token": token,
                        },
                        success: function(data) {
                            console.log(data);
                            location.reload();


                        },
                        error: function() {
                            console.log("did not delete");
                        }


                    });
                }


            });
        });