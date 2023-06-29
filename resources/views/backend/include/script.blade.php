 <!-- General JS Scripts -->
 <script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
 <!-- JS Libraies -->
 {{-- <script src="{{ asset('backend/assets/bundles/apexcharts/apexcharts.min.js') }}"></script> --}}
 <!-- Page Specific JS File -->
 {{-- <script src="{{ asset('backend/assets/js/page/index.js') }}"></script> --}}
 <!-- Template JS File -->
 <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
 <!-- Custom JS File -->
 <script src="{{ asset('backend/assets/js/custom.js') }}"></script>


 {{-- <script src="{{ asset('backend/assets/bundles/prism/prism.js') }}"></script> --}}


 <!--DATABALES-->
 <script src="{{ asset('backend/assets/bundles/datatables/datatables.min.js') }}"></script>
 <script src="{{ asset('backend/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
 </script>
 {{-- <script src="{{ asset('backend/assets/bundles/datatables/export-tables/dataTables.buttons.min.js') }}"></script> --}}
 {{-- <script src="{{ asset('backend/assets/bundles/datatables/export-tables/buttons.flash.min.js') }}"></script> --}}
 {{-- <script src="{{ asset('backend/assets/bundles/datatables/export-tables/jszip.min.js') }}"></script> --}}
 {{-- <script src="{{ asset('backend/assets/bundles/datatables/export-tables/pdfmake.min.js') }}"></script> --}}
 {{-- <script src="{{ asset('backend/assets/bundles/datatables/export-tables/vfs_fonts.js') }}"></script> --}}
 {{-- <script src="{{ asset('backend/assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script> --}}

 <script src="{{ asset('backend/assets/js/page/datatables.js') }}"></script>
 <!--DATATABLES-->


 {{-- <script>
     window.addEventListener('closeModal', event => {
         $('.modal').modal('hide');
     })
 </script> --}}




 <script src="{{ asset('backend/assets/js/bootstrap-confirmation.min.js') }}"></script>
 <script>
     $('[data-toggle=confirmation]').confirmation({
         rootSelector: '[data-toggle=confirmation]',
         // other options
     });
 </script>



 <script src="{{ asset('backend/assets/bundles/summernote/summernote-bs4.js') }}"></script>

 <script>
     window.addEventListener('alert', event => {
         toastr[event.detail.type](event.detail.message,
             event.detail.title ?? ''), toastr.options = {
             "closeButton": true,
             //  "progressBar": true,
             "preventDuplicates": false,
         }
     });
 </script>
 @livewireScripts
 @stack('scripts')
