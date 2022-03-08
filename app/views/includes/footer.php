      <footer class="main-footer">
        <!-- <div class="footer-left col-md-6">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div> -->
        <div class="footer-right col-md-3">
          2.3.0
        </div>

        <div class="col-md-12">
          Distributed by <a href="https://themewagon.com/">Themewagon</a>
        </div>
      </footer>
    </div>
  </div>
  </div>

<!-- General JS Scripts -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> --> 
<script src="<?php echo URLROOT ?>/public/js/stisla.js"></script>

<!-- JS Libraies -->
<!-- <script src="../node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
<script src="../node_modules/chart.js/dist/Chart.min.js"></script>
<script src="../node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="../node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
<script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->

<!-- Template JS File -->
<script src="<?php echo URLROOT ?>/public/js/scripts.js"></script>

<!-- Page Specific JS File -->
<script src="<?php echo URLROOT ?>/public/js/page/index-0.js"></script>
<script src="<?php echo URLROOT ?>/public/js/page/auth-register.js"></script>

<script src="<?php echo URLROOT ?>/public/js/custom.js"></script>

<script>

  // datetime picker
  $(function () {
    $('#datetimepicker1').datetimepicker();         
    $('#datetimepicker2').datetimepicker();         
  });

  $(document).ready(function() {

    // Show data tables
    $('#table-data').DataTable({
      'scrollY' : '300px', // ukuran tinggi tabel
      'scrollCollapse' : true, // bisa scroll
      'paging' : true, // menggunakan paging
      'ordering' : false, // mengurutkan data
    });

    $('#table-nama').DataTable({
      'paging' : true 
    })

    $('#table-pelaku').DataTable({
      'paging' : true 
    })

    $('#table-korban').DataTable({
      'paging' : true 
    })

    $('#table-saksi').DataTable({
      'paging' : true 
    })

    $(document).on('click', '#select-nama', function() {
      var name = $(this).data('name')
      $('#nama_pelapor').val(name)
      $('#search-name-modal').modal('hide')
    })

    $(document).on('click', '#select-pelaku', function() {
      var name = $(this).data('name')
      $('#pelaku').val(name)
      $('#search-pelaku-modal').modal('hide')
    })

    $(document).on('click', '#select-korban', function() {
      var name = $(this).data('name')
      $('#korban').val(name)
      $('#search-korban-modal').modal('hide')
    })

    $(document).on('click', '#select-saksi', function() {
      var name = $(this).data('name')
      var alamat = $(this).data('address')
      $('#nama_saksi').val(name)
      $('#alamat').val(alamat)
      $('#search-saksi-modal').modal('hide')
    })
    
    $('#test').on('click', function() {
      Swal.fire("button clicked")
    })

    setTimeout(function() {
      $('.alert').fadeTo(500, 0).slideUp(500, function() {
        $(this).remove()
      });
    }, 3000);

    // Chart

    // var xValues = ["admin", "operator", "user"];
    // var yValues = [31, 10, 12];
    // var barColors = ['blue', 'orange', 'brown'];

    // var chart = new Chart('chart', {
    //   type: 'line',
    //   data: {
    //     labels: xValues ,
    //     datasets: [{
    //       backgroundColor: barColors,
    //       data: yValues,
    //     }]
    //   },
    //   options: {
    //     legend: {display: false},
    //     title: {
    //       display: true,
    //       text: 'Jumlah Role User'
    //     }
    //   },
    // })

  });


</script>

</body>

</html>