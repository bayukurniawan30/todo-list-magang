<div id="modal-delete-list" uk-modal>
    <div class="uk-modal-dialog">
        <form action="include/action/delete-list.php" method="post">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Delete List</h3>
        </div>
        <div class="uk-modal-body">
        <input id="delete-bind-todo-id" type="hidden" name="id" value="" required>
            <p class="uk-margin-remove-top">Are you sure want to delete <span id="delete-bind-todo" class="uk-text-bold"></span> in <span id="delete-bind-list" class="uk-text-bold"></span> list?</p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-danger" type="submit">Yes, Delete it</button>
        </div>
        </form>
    </div>
</div>