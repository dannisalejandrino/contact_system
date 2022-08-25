<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function(){

        function contact(page, search_string) {
            $.ajax({
                url: "/pagination/paginate-data?page="+page+"&search_string="+search_string,
                success: function(data){
                    $('.table-data').html('');
                    $('.table-data').html(data);
                }
            })
        }

        //Pagination
        $(document).on('click','.pagination a', function(e){
            e.preventDefault();

            let page = $(this).attr('href').split('page=')[1];
            let search_string = $('#search').val();

            $('#hidden_page').val(page);
            $('#search_string').val(search_string);

            console.log(page);
            console.log(search_string);

            contact(page, search_string);
        })

        //Search Contact
        $("#search").on('keyup', function(e){
            e.preventDefault();
            let search_string = $('#search').val();
            var page = $('#hidden_page').val();

            contact(page, search_string);

            $.ajax({
                url: "{{ route('search.contact') }}",
                method: 'GET',
                data: {search_string: search_string},
                success: function(data) {
                    $('.table-data').html('');
                    $('.table-data').html(data);
                    if(data.status=='nothing_found') {
                        $('.table-data').html('<span class="text-danger"> Nothing Found </span>')
                    }
                }
            })
        })

        //Add Contact
        $(document).on('click', '.add_contact_btn', function(e){
            e.preventDefault();
            $('.errMsgContainer').html('');
            $('#name').val('');
            $('#company').val('');
            $('#phone').val('');
            $('#email').val('');
        })

        $(document).on('click', '.add_contact', function(e){
            e.preventDefault();
            let name = $('#name').val();
            let company = $('#company').val();
            let phone = $('#phone').val();
            let email = $('#email').val();
            let page = $('#hidden_page').val();
            let search_string = $('#search').val();

            $.ajax({
                url: "{{ route('add.contact') }}",
                method: 'post',
                data: {name: name, company: company, phone: phone, email: email},
                dataType: "json",
                success: function(res) {
                     console.log('test 2')
                     if(res.status == 'success') {
                        $('#addModal').modal('hide');
                        $('#addProductForm')[0].reset();
                        $('.table-data').load(location.href+' .table-data');
                        contact(page, search_string);

                        Command: toastr["success"]("Contact Added")
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                     }
                },
                error: function(err) {
                    // console.log('test test')
                    let error = err.responseJSON;

                    console.log(error);
                    $.each(error.errors, function(index, value){
                        console.log('test test2')
                        $('.errMsgContainer').append('<span class="text-danger">'+ value +'</span>' + '<br>');
                    });
                }
            });
        })

        //show contact value in update form
        $(document).on('click','.update_product_form', function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            let company = $(this).data('company');
            let phone = $(this).data('phone');
            let email = $(this).data('email');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_company').val(company);
            $('#up_phone').val(phone);
            $('#up_email').val(email);
        })

        //update contact data
        $(document).on('click', '.update_product', function(e){
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();
            let up_company = $('#up_company').val();
            let up_phone = $('#up_phone').val();
            let up_email = $('#up_email').val();
            let page = $('#hidden_page').val();
            let search_string = $('#search').val();

            $.ajax({
                url: "{{ route('update.contact') }}",
                method: 'post',
                data: {up_id: up_id, up_name: up_name, up_company: up_company, up_phone: up_phone, up_email: up_email},
                dataType: "json",
                success: function(res) {
                     if(res.status == 'success') {
                        $('#updateModal').modal('hide');
                        $('#updateProductForm')[0].reset();
                        $('.table-data').load(location.href+' .table-data');
                        contact(page, search_string);

                        Command: toastr["success"]("Contact Updated")
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                     }
                },
                error: function(err) {
                    let error = err.responseJSON;

                    $.each(error.errors, function(index, value){
                        $('.errMsgContainer').append('<span class="text-danger">'+ value +'</span>' + '<br>');
                    });
                }
            });
        })

        //show contact value in update form
        $(document).on('click','.delete_contact_form', function(){
            let id = $(this).data('id');

            $('#del_id').val(id);
        })

        //delete contact data
        $(document).on('click', '.delete_contact', function(e){
            e.preventDefault();
            // let product_id = $(this).data('id');
            let product_id = $('#del_id').val();
            let page = $('#hidden_page').val();
            let search_string = $('#search').val();

            // if(confirm('Are you sure to delete contact ??')) {
                $.ajax({
                    url: "{{ route('delete.contact') }}",
                    method: 'post',
                    data: {contact_id: product_id},
                    dataType: "json",
                    success: function(res) {
                        if(res.status == 'success') {
                            $('#deleteModal').modal('hide');
                            $('.table-data').load(location.href+' .table-data');
                            contact(page, search_string);
                            Command: toastr["success"]("Contact Deleted")
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                        }
                    }
                });
            // }
        })
    })
</script>
