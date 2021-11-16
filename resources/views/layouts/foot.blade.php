<!--start switcher-->
<div class="switcher-wrapper">
    <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
    </div>
    <div class="switcher-body">
        <h5 class="mb-0 text-uppercase">SITE CUSTOMIZER</h5>
        <hr />
        <h6 class="mb-0">CHANGE MODE</h6>
        <hr />
        <div class="d-flex align-items-center justify-content-between">
            <div class="custom-control custom-radio">
                <input type="radio" id="darkmode" name="customRadio" class="custom-control-input" checked>
                <label class="custom-control-label" for="darkmode">Dark Mode</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="lightmode" name="customRadio"  class="custom-control-input">
                <label class="custom-control-label" for="lightmode">Light Mode</label>
            </div>
        </div>
    </div>
</div>
<!--end switcher-->
<!-- JavaScript -->
<!-- jQuery first, then Popper.js') }}, then Bootstrap JS -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
        var type = "{{ Session::get('alert', 'info') }}";
        switch(type){

            case 'info':
            toastr.options.timeOut = 10000;
            toastr.info("{{Session::get('message')}}");
            break;

            case 'success':
            toastr.options.timeOut = 10000;
            toastr.success("{{Session::get('message')}}");
            break;

            case 'warning':
            toastr.options.timeOut = 10000;
            toastr.warning("{{Session::get('message')}}");
            var audio = new Audio('audio.mp3');
            break;

            case 'error':
            toastr.options.timeOut = 10000;
            toastr.error("{{Session::get('message')}}");
            break;
        }
    @endif
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>



<script>
    $('#verify').click(function (e) {
        $('#show_acc').addClass('hide');
        $('#message').addClass('hide');
        $('#message').html('');


        e.preventDefault();
        let bank_code = $('#bank_code option:selected').val();
        let account_number = $('#account_number').val();



        if(bank_code === 'Select Bank'){
            toastr.error("Please select a bank");
            return false;
        }
        if(account_number === ''){
            toastr.error("Account Number is required");
            return false;
        }


        toastr.info("Please wait while loading...");

        let url =
            `https://api.paystack.co/bank/resolve?account_number=${account_number}&bank_code=${bank_code}`;

        axios.get(url, {
                headers: {
                    'Authorization': 'Bearer sk_test_57c8d08fac29b5c49b06cf06a7fa45b13cd6441e'
                }
            })
            .then(response => {
                if (response.data.message) {
                    $('#message').toggleClass('hide');
                    $('#message').removeClass('alert-danger show');
                    $('#message').addClass('alert-success show');
                    $('#message').append('Account Number is Valid.');
                    $(this).addClass('hide');
                    $("#save").toggleClass('hide');
                    $('#show_acc').toggleClass('hide');
                    $('#account_name').val(`${response.data.data.account_name}`);

                    $('#acc_name').val(`${response.data.data.account_name}`);

                }
            })
            .catch((error) => {
                if (error.response) {
                    if (error.response.data) {
                        if (error.response.data.message) {
                            $('#message').toggleClass('hide');
                            $('#message').removeClass('alert-success show');
                            $('#message').addClass('alert-danger show');
                            $('#message').append('Unable to find account');
                        }
                    }
                }
            });

    })

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

</script>


<!--plugins-->
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/js/widgets.js') }}"></script>
<!-- App JS -->
<script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    new PerfectScrollbar('.dashboard-social-list');
    new PerfectScrollbar('.dashboard-top-countries');

</script>

@yield('js')

</body>

</html>
