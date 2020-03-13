<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border"><h3 class="box-title">Subjects List:</h3>
                <button class="btn btn-primary btn-sm pull-right" type="button" id="add_new_sub"><i class="fa fa-plus-circle"></i> Add</button></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="patient_details">
                            <form name="test_form" id="test_form" method="POST">
                                <table class="table table-hover table-bordered dataTable" id="data_grid" width="100%"></table>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var data_url = base_url + 'fetch-subject-data';
    var data_grid = '';
    $(document).ready(function () {

        $('#add_exam_modal_box #add_exam_form #exam_title').keyup(function () {
            $('#add_exam_modal_box #add_exam_form #exam_code').val($(this).val().replace(/ /g, "_").toUpperCase());
        });

        var validator = $('#add_exam_form').validate({
            rules: {
                exam_title: {
                    remote: {
                        url: base_url + 'check_exam_title',
                        type: 'POST'
                    }
                },
                exam_duration: {
                    digits: true
                }
            },
            messages: {
                exam_title: {
                    remote: 'This title already exists please use different title',
                }
            }
        });

        $('#add_new_exam').on('click', function () {
//            validator.resetForm();
//            $("label.error").hide();
//            $(".error").removeClass("error");
            $('#add_exam_modal_box').modal({
                keyboard: false,
                backdrop: 'static'
            }, 'show');
        });



        $('#add_exam_modal_box').on('click', '#btn-ok', function () {
            if ($('#add_exam_form').valid()) {
                var form_data = $('#add_exam_form').serializeArray();
                $.ajax({
                    url: base_url + 'save_exam_data',
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (response) {
                        if (response.status) {
                            display_grid();
                        } else {
                            alert('error in saving');
                        }
                    }
                });
            }
        });
        var columns = [
            {
                title: 'Subject',
                className: 'grid_cuid',
                target: 0,
                data: function (item) {
                    return item.subject_name;
                }
            },
            {
                title: 'Code',
                className: 'grid_name',
                target: 1,
                data: function (item) {
                    return item.subject_code;
                }
            }
        ];

        function display_grid() {
            if (data_grid) {
                data_grid.draw();
            } else {
                data_grid = $('#data_grid').DataTable({
                    'columns': columns,
                    'paging': true,
                    'searching': false,
                    'autoWidth': false,
                    'pageLength': 15,
                    'lengthChange': true,
                    'aLengthMenu': [15, 30, 50, 100],
                    'info': false,
                    'order': [[0, 'asc']],
                    'processing': true,
                    'serverSide': true,
                    'ajax': {
                        'url': data_url,
                        'type': 'POST',
                        'data': function (d) {
                            return $.extend({}, d, {
                                "search_criteria": $('#search_form').serializeArray()
                            });
                        }
                    },
                    'dom': '<<"row-fluid no-pad" <"col-md-2 no-pad" l><"col-md-10 no-pad" <"col-md-12 no-pad" <"page-jump pull-right col-sm-6" <"pull-right marginL20" p>>>>><t>',
                    'scrollY': 300,
                    'scrollX': true,
                    'scrollCollapse': 'truem"iflp<"clear">>'
                });//datatable
            }
        }

        display_grid();

        $(window).bind('resize', function () {
            /*the line below was causing the page to keep loading.
             $('#tableData').dataTable().fnAdjustColumnSizing();
             Below is a workaround. The above should automatically work.*/
            $('#data_grid').css('width', '100%');
            $('#data_grid').dataTable().fnAdjustColumnSizing();
        });
    });
</script>