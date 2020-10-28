</div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Green Enterprices <?php echo date("Y");?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

   

  <!-- Bootstrap core JavaScript-->
  <script src="../../asset/boostrap_js/jquery-3.5.1.min.js"></script>
  <script src="../../asset/boostrap_js/bootstrap.bundle.min.js"></script>
  <script src="../../asset/boostrap_js/sweetalert-new.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../asset/boostrap_js/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../asset/boostrap_js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../asset/boostrap_js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../../asset/boostrap_js/chart-area-demo.js"></script>
  <script src="../../asset/boostrap_js/chart-pie-demo.js"></script>
  <script src="../../functions/users/public_user.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>

  <script>
    //Disabled scrolling
    $(document).on("wheel", "input[type=number]", function (e) {
        $(this).blur();
    });

    // -----------------Change the format-------------------------------------s
    $('input[type="date"]').change(function(){
      this.value.split("-").reverse().join("-"); 
    });





  </script>
  