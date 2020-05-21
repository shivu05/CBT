<?php for ($i = 0; $i < $no_of_questions; $i++) : ?>
    <div class="col-md-12" style="margin-top: 1%;">
        <hr/>
        <div class="col-md-6">
            <span>Q <?= ($i + 1); ?>)</span>
            <textarea id="question_box_<?= $i; ?>" name="question_box_<?= $i; ?>" class="question_box form-control"></textarea>
        </div>
        <div class="col-md-6">
            <table class="table" style="margin-top: 1%;">
                <tr>
                    <td>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">A</div>
                                <input type="text" class="ckeditor_input form-control" name="q<?= $i; ?>_ans_a" id="q<?= $i; ?>_ans_a" placeholder="Answer A">
                                <div class="input-group-addon"><input type="radio" name="q<?= $i; ?>_correct_ans" value="q<?= $i; ?>_ans_a" class="form-check-input" /></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">B</div>
                                <input type="text" class="ckeditor_input form-control" name="q<?= $i; ?>_ans_b" id="q<?= $i; ?>_ans_b" placeholder="Answer B">
                                <div class="input-group-addon"><input type="radio" name="q<?= $i; ?>_correct_ans" value="q<?= $i; ?>_ans_b" class="form-check-input" /></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">C</div>
                                <input type="text" class="ckeditor_input form-control" name="q<?= $i; ?>_ans_c" id="q<?= $i; ?>_ans_c" placeholder="Answer C">
                                <div class="input-group-addon"><input type="radio" name="q<?= $i; ?>_correct_ans" value="q<?= $i; ?>_ans_c" class="form-check-input" /></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                            <div class="input-group">
                                <div class="input-group-addon">D</div>
                                <input type="text" class="ckeditor_input form-control" name="q<?= $i; ?>_ans_d" id="q<?= $i; ?>_ans_d" placeholder="Answer D">
                                <div class="input-group-addon"><input type="radio" name="q<?= $i; ?>_correct_ans" value="q<?= $i; ?>_ans_d" class="form-check-input" /></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
<?php endfor; ?>