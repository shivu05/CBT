<?php
$subjects_dropdown = "";
if (!empty($subjects)) {
    foreach ($subjects as $subject) {
        $subjects_dropdown .= '<option value="' . $subject['subject_id'] . '">' . $subject['subject_name'] . '</option>';
    }
}

$examss_dropdown = "";
if (!empty($exams)) {
    foreach ($exams as $exam) {
        $examss_dropdown .= '<option value="' . $exam['exam_id'] . '">' . $exam['exam_title'] . '</option>';
    }
}
?>
<style>
    table tr{
        margin-bottom: 10px;
    }
</style>
<div class="row">
    <form name="qp_form" id="qp_form" method="POST" action="<?php echo base_url('save_questions'); ?>">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">Create question paper:</h3>
                    <button class="btn btn-primary btn-sm pull-right" type="button" id="add_new_exam"><i class="fa fa-plus-circle"></i> List</button></div>
                <div class="box-body">
                    <div id="qp_details">

                        <div class="row">
                            <div class="col-md-3">
                                <select id="subject_id" name="subject_id" class="form-control chosen-select required" data-placeholder="Select subject">
                                    <option value="">Select subject</option>
                                    <?= $subjects_dropdown ?>
                                </select>
                                <span class="error"></span>
                            </div>
                            <div class="col-md-3">
                                <select id="exam_id" name="exam_id" class="form-control chosen-select required" data-placeholder="Select exam">
                                    <option value="">Select exam</option>
                                    <?= $examss_dropdown ?>
                                </select>
                                <span class="error"></span>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="no_of_questions" id="no_of_questions" class="form-control digits-only" placeholder="no.of questions"/>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="exam_duration" id="exam_duration" class="form-control digits-only" placeholder="Exam duration in minutes"/>
                            </div>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <button type="button" name="load_questions" id="load_questions" class="btn btn-primary btn-sm pull-right">Add questions</button>
                            <button type="button" name="save_questions" id="save_questions" style="margin-right:4px;" class="btn btn-secondary btn-sm pull-right">Save questions</button>&nbsp;&nbsp;&nbsp;&nbsp;

                        </div>

                    </div>
                    <div id="ques_div"></div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        function initiate_ckeditor() {
            $('.question_box').each(function (e) {
                CKEDITOR.replace(this.id, {
                    extraPlugins: 'ckeditor_wiris'
                });
            });
        }
        $('.chosen-select').chosen();
        $.validator.setDefaults({ignore: ":hidden:not(.chosen-select)"})
        $('#qp_form').validate({
            rules: {
                no_of_questions: {
                    required: true,
                    min: 1
                }
            },
            errorPlacement: function (error, element)
            {
                if (element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $('#qp_form').on('click', '#load_questions', function () {
            if ($('#qp_form').valid()) {
                var no_of_qp = $('#qp_form #no_of_questions').val();
                $.ajax({
                    url: base_url + 'generate_questions',
                    type: 'POST',
                    data: {'no_of_qp': no_of_qp},
                    success: function (response) {
                        $('#ques_div').html(response);
                        initiate_ckeditor();

                    }
                });
            }
        });

        $('#qp_form').on('click', '#save_questions', function () {
            /*var url = base_url + 'save_questions';
             var form_data = $('#qp_form').serializeArray();
             $.ajax({
             url: url,
             type: 'POST',
             dataType: 'json',
             data: form_data,
             success: function (response) {
             console.log(response);
             }
             });*/
            $('#qp_form').submit();
        });
    });
</script>