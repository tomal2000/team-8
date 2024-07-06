<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script src="{{ asset('admin/assets/vendor/jquery-numeric/jquery-numeric-master/jquery.numeric.min.js') }}"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('admin/assets/js/main.js') }}"></script>
  <script>
    $('.amount').numeric(
                {negative: false, decimalPlaces: 2},
                function () {
                    alert('Positive integers only');
                    this.value = '';
                    this.focus();
                }
            );
    jQuery.validator.addMethod(
    "exactLength",
    function (value, element, param) {
        return this.optional(element) || value.length == param;
    },
    $.validator.format("Please enter exactly {0} characters.")
);

jQuery.validator.addMethod(
    "bankAccount",
    function (value, element) {
        return (
            this.optional(element) || value.length == 13 || value.length == 17
        );
    },
    "Bank Account Must Have 13 or 17 Digit."
);

jQuery.validator.addMethod(
    "nid",
    function (value, element) {
        return (
            this.optional(element) || value.length == 10 || value.length == 13 || value.length == 17
        );
    },
    "NID Must Have 10 or 17 Digit."
);

jQuery.validator.addMethod(
    "exactLengthMobile",
    function (value, element) {
        return this.optional(element) || value.length == 11;
    },
    $.validator.format("Mobile Number Must Be 11 Digits")
);
jQuery.validator.addMethod(
    "exactStartingMobile",
    function (value, element) {
        return (
            this.optional(element) ||
            value.slice(0, 3) == "018" ||
            value.slice(0, 3) == "013" ||
            value.slice(0, 3) == "017" ||
            value.slice(0, 3) == "019" ||
            value.slice(0, 3) == "014" ||
            value.slice(0, 3) == "016" ||
            value.slice(0, 3) == "015"
        );
    },
    $.validator.format(
        "Mobile Number Must Be Start With 018,013,017,019,014,016,015"
    )
);
  </script>
  @stack('scripts')
