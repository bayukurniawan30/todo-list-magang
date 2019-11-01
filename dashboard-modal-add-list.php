<div id="modal-add-list" uk-modal>
    <div class="uk-modal-dialog">
        <form action="include/action/add-list.php" method="post">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Add List</h3>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <input id="input-todo" class="uk-input" type="text" name="todo" placeholder="ToDo" required>
            </div>
            <div class="uk-margin">
                <select class="uk-select" name="category_id" required>
                    <option value="">Select Category</option>
                    <?php
                        if ($fetchCategories):
                            foreach ($fetchCategories as $category):
                    ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php
                            endforeach;
                        endif;
                    ?>
                </select>
            </div>
            <div class="uk-margin">
                <input id="input-assign" class="uk-input" type="text" name="assign" placeholder="Select Date" required>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="submit">Save</button>
        </div>
        </form>
    </div>
</div>

<script>
    $(function() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd = '0'+dd
        } 

        if(mm<10) {
            mm = '0'+mm
        } 

        today = mm + '/' + dd + '/' + yyyy;

        $('#input-assign').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            startDate: today,
            minDate: today,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10)
        }, function(start, end, label) {
            var years = moment().diff(start, 'years');
        });
    });
</script>