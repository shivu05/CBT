<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border"><h3 class="box-title">Exams List:</h3>
                <button class="btn btn-primary btn-sm pull-right" type="button" id="add_new_exam"><i class="fa fa-plus-circle"></i> Add</button></div>
            <div class="box-body">
                <div id="patient_details">
                    <form name="test_form" id="test_form" method="POST">
                        <table class="table table-hover table-bordered dataTable" id="data_grid" width="100%"></table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_exam_modal_box" tabindex="-1" role="dialog" aria-labelledby="add_exam_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="add_exam_modal_label">Add New Exam: </h4>
            </div>
            <div class="modal-body" id="add_exam_modal_body">
                <form name="add_exam_form" id="add_exam_form" method="POST">
                    <div class="form-group">
                        <label for="exam_title">Exam title</label>
                        <input type="text" class="form-control required" name="exam_title" id="exam_title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="exam_code">Exam code:</label>
                        <input type="text" class="form-control required" id="exam_code" name="exam_code" placeholder="Unique code">
                    </div>
                    <div class="form-group">
                        <label for="exam_date">Exam date:</label>
                        <input type="text" class="form-control required date_picker" id="exam_date" name="exam_date" placeholder="Date">
                    </div>
                    <div class="form-group">
                        <label for="exam_date">Exam duration:</label>
                        <input type="text" class="form-control required" id="exam_duration" name="exam_duration" placeholder="Duration">
                    </div>
                    <div class="form-group">
                        <label for="exam_start_time">Exam start time:</label>
                        <input type="time" class="form-control required" id="exam_start_time" name="exam_start_time" placeholder="Start time">
                    </div>
                    <div class="form-group">
                        <label for="exam_end_time">Exam end time:</label>
                        <input type="time" class="form-control required" id="exam_end_time" name="exam_end_time" placeholder="End time">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-ok">Save</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var data_url = base_url + 'fetch-exam-data';
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
                title: 'Title',
                className: 'grid_cuid',
                target: 0,
                data: function (item) {
                    return item.exam_title;
                }
            },
            {
                title: 'Unique code',
                className: 'grid_name',
                target: 1,
                data: function (item) {
                    return item.exam_code;
                }
            },
            {
                title: 'Exam date',
                className: 'grid_name',
                target: 2,
                data: function (item) {
                    return item.exam_date;
                }
            },
            {
                title: 'Start time',
                className: 'grid_name',
                target: 3,
                data: function (item) {
                    return item.exam_start_time;
                }
            },
            {
                title: 'End time',
                className: 'grid_name',
                target: 4,
                data: function (item) {
                    return item.exam_end_time;
                }
            },
            {
                title: 'Duration',
                className: 'grid_name',
                target: 5,
                data: function (item) {
                    return item.exam_duration;
                }
            },
            {
                title: 'Action',
                className: 'grid_name',
                target: 6,
                data: function (item) {
                    return '<button type="button" class="btn-link"><i class="fa fa-edit"></i></button> <button type="button" class="btn-link"><i class="fa fa-trash text-danger"></i></button>';
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