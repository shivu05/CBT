<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border"><h3 class="box-title">Subjects List:</h3></div>
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
                        <h4>Add new subject:</h4>
                        <form method="POST" class="card" name="add_subject" id="add_subject">
                            <div class="form-group">
                                <label for="subject_name">Subject Name:</label>
                                <input type="text" class="form-control required" name="subject_name" id="subject_name" placeholder="Subject name">
                            </div>
                            <div class="form-group">
                                <label for="subject_code">Subject Code</label>
                                <input type="text" class="form-control required" name="subject_code" id="subject_code" placeholder="Subject Code">
                            </div>
                            <div class="form-group pull-right">
                                <button type="reset" class="btn btn-secondary" id="reset" name="reset">Reset</button>
                                <button type="button" class="btn btn-primary" id="btn-ok">Save</button>
                            </div>
                        </form>
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

        $('#add_subject #subject_code').keyup(function () {
            $('#add_subject #subject_code').val($(this).val().replace(/ /g, "_").toUpperCase());
        });

        var validator = $('#add_subject').validate({
            rules: {
                subject_name: {
                    remote: {
                        url: base_url + 'check_if_data_exists',
                        type: 'POST',
                        data: {
                            column_name: function () {
                                return 'subject_name';
                            }
                        }
                    },
                    minlength: 3
                },
                subject_code: {
                    remote: {
                        url: base_url + 'check_if_data_exists',
                        type: 'POST',
                        data: {
                            column_name: function () {
                                return 'subject_code';
                            }
                        }
                    }
                }
            },
            messages: {
                subject_name: {
                    remote: 'This Subject name already exists',
                },
                subject_code: {
                    remote: 'This Subject code already exists',
                }
            }
        });

        $('#add_subject').on('click', '#btn-ok', function () {
            if ($('#add_subject').valid()) {
                var form_data = $('#add_subject').serializeArray();
                $.ajax({
                    url: base_url + 'save_subject',
                    type: 'POST',
                    dataType: 'json',
                    data: form_data,
                    success: function (response) {
                        if (response.status) {
                            display_grid();
                            $('#add_subject #reset').trigger('click');
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