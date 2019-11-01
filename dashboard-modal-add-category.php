<div id="modal-add-category" uk-modal>
    <div class="uk-modal-dialog">
        <form action="include/action/add-category.php" method="post">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Add Category</h3>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <div class="uk-inline" style="width: 100%">
                    <span class="uk-form-icon" uk-icon="icon: folder"></span>
                    <input id="input-name" class="uk-input" type="text" name="name" placeholder="Category Name" required>
                </div>
            </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="submit">Save</button>
        </div>
        </form>
    </div>
</div>