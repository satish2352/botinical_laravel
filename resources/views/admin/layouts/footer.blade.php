</div>
<div class="footer-copyright-area navbar-fixed-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-copy-right">
                    <p>Copyright &copy; {{ date('Y') }} <a href="https://www.sumagoinfotech.com"
                            target="_blank"> Made with Passion by Sumago Infotech.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script src="{{ asset('js/vendor/jquery-1.11.3.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/jquery-price-slider.js') }}"></script>
<script src="{{ asset('js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.sticky.js') }}"></script>
<script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('js/scrollbar/mCustomScrollbar-active.js') }}"></script>
<script src="{{ asset('js/metisMenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('js/metisMenu/metisMenu-active.js') }}"></script>
<script src="{{ asset('js/morrisjs/raphael-min.js') }}"></script>
<script src="{{ asset('js/morrisjs/morris.js') }}"></script>
<script src="{{ asset('js/morrisjs/morris-active.js') }}"></script>
<script src="{{ asset('js/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/sparkline/jquery.charts-sparkline.js') }}"></script>
<script src="{{ asset('js/calendar/moment.min.js') }}"></script>
<script src="{{ asset('js/calendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/calendar/fullcalendar-active.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/data-table/bootstrap-table.js') }}"></script>
<script src="{{ asset('js/data-table/tableExport.js') }}"></script>
<script src="{{ asset('js/data-table/data-table-active.js') }}"></script>
<script src="{{ asset('js/data-table/bootstrap-table-editable.js') }}"></script>
<script src="{{ asset('js/data-table/bootstrap-editable.js') }}"></script>
<script src="{{ asset('js/data-table/bootstrap-table-resizable.js') }}"></script>
<script src="{{ asset('js/data-table/colResizable-1.5.source.js') }}"></script>
<script src="{{ asset('js/data-table/bootstrap-table-export.js') }}"></script>
<script src="{{ asset('js/editable/jquery.mockjax.js') }}"></script>
<script src="{{ asset('js/editable/mock-active.js') }}"></script>
<script src="{{ asset('js/editable/select2.js') }}"></script>
<script src="{{ asset('js/editable/moment.min.js') }}"></script>
<script src="{{ asset('js/editable/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('js/editable/bootstrap-editable.js') }}"></script>
<script src="{{ asset('js/editable/xediable-active.js') }}"></script>
<script src="{{ asset('js/chart/jquery.peity.min.js') }}"></script>
<script src="{{ asset('js/peity/peity-active.js') }}"></script>
<script src="{{ asset('js/tab.js') }}"></script>
<link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css') }}">
<script src="{{ asset('https://cdn.jsdelivr.net/npm/flatpickr') }}"></script>


<script>
    $('.delete-btn').click(function(e) {
        alert(delete_id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#delete_id").val($(this).attr("data-id"));
                $("#deleteform").submit();
            }
        })

    });
</script>

<script>
    ClassicEditor
        .create(document.querySelector('.english_description'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('.hindi_description'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    $(document).ready(() => {
        $("#image").change(function() {
            $('#english').css('display', 'none');
            $("#english_imgPreview").show();

            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#english_imgPreview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
        $("#image_two").change(function() {
            $('#english_two').css('display', 'none');
            $("#english_imgPreview_two").show();

            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#english_imgPreview_two").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
        $("#image_three").change(function() {
            $('#english_three').css('display', 'none');
            $("#english_imgPreview_three").show();

            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#english_imgPreview_three").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
        $("#image_four").change(function() {
            $('#english_four').css('display', 'none');
            $("#english_imgPreview_four").show();

            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#english_imgPreview_four").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
        $("#image_five").change(function() {
            $('#english_five').css('display', 'none');
            $("#english_imgPreview_five").show();

            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#english_imgPreview_five").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });


        $("#hindi_image").change(function() {
            $('#hindi_english').css('display', 'none');
            $("#hindi_imgPreview").show();

            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#hindi_imgPreview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $("#english_audio_link").change(function() {
            $('#englishaudio').css('display', 'none');
            $("#english_audioPreview").show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    const audioSrc = event.target.result;
                    $("#english_audioPreview").html(`<audio controls><source src="${audioSrc}" type="audio/mpeg"></audio>`);
                };
                reader.readAsDataURL(file);
            }
        });

        $("#hindi_audio_link").change(function() {
            $('#hindiaudio').css('display', 'none');
            $("#hindi_audioPreview").show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    const audioSrc = event.target.result;
                    $("#hindi_audioPreview").html(`<audio controls><source src="${audioSrc}" type="audio/mpeg"></audio>`);
                };
                reader.readAsDataURL(file);
            }
        });

        $("#english_video_upload").change(function() {
            $('#englishvideo').css('display', 'none');
            $("#english_videoPreview").show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    const videoSrc = event.target.result;
                    $("#english_videoPreview").html(`<video width="320" height="240" controls><source src="${videoSrc}" type="video/mp4"></video>`);
                };
                reader.readAsDataURL(file);
            }
        });

        $("#hindi_video_upload").change(function() {
            $('#hindivideo').css('display', 'none');
            $("#hindi_videoPreview").show();
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    const videoSrc = event.target.result;
                    $("#hindi_videoPreview").html(`<video width="320" height="240" controls><source src="${videoSrc}" type="video/mp4"></video>`);
                };
                reader.readAsDataURL(file);
            }
        });

//         $("#english_video_upload").change(function() {
//     $('#englishvideo').css('display', 'none');
//     $("#english_videoPreview").show();
//     const file = this.files[0];
//     if (file) {
//         let reader = new FileReader();
//         reader.onload = function(event) {
//             const videoSrc = event.target.result;
//             $("#english_videoPreview").html(`<video width="320" height="240" controls><source src="${videoSrc}" type="video/mp4"></video>`);
//         };
//         reader.readAsDataURL(file);
//     }
// });

// $("#hindi_video_upload").change(function() {
//     $('#hindivideo').css('display', 'none');
//     $("#hindi_videoPreview").show();
//     const file = this.files[0];
//     if (file) {
//         let reader = new FileReader();
//         reader.onload = function(event) {
//             const videoSrc = event.target.result;
//             $("#hindi_videoPreview").html(`<video width="320" height="240" controls><source src="${videoSrc}" type="video/mp4"></video>`);
//         };
//         reader.readAsDataURL(file);
//     }
// });


          
    });
</script>

<script>
    // $('.delete-btn').click(function(e) {
    $(document).on('click', '.delete-btn', function(e) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#delete_id").val($(this).attr("data-id"));
                $("#deleteform").submit();
            }
        })

    });
</script>

<script>
    $(document).on('click', '.show-btn', function(e) {
    $("#show_id").val($(this).attr("data-id"));
    $("#showform").submit();
});

</script>


<script>
    $('.edit-btn').click(function(e) {
        $("#edit_id").val($(this).attr("data-id"));
        $("#editform").submit();
     })
 </script>
<script>
  
        $(document).on('click', '.edit-user-btn', function(e) {
        $("#edit_user_id").val($(this).attr("data-id"));
        $("#edituserform").submit();
    })
</script>

<script>
        $(document).on('click', '.active-btn', function(e) {
        $("#active_id").val($(this).attr("data-id"));
        $("#activeform").submit();
    })
</script>
<script>
    setTimeout(function() {
            $(".alert").alert('close');
        }, 1000); // 1000 milliseconds = 1 second
    </script>
</body>

</html>
