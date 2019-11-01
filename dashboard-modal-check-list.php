<div id="modal-check-list" uk-modal>
    <div class="uk-modal-dialog">
        <form action="include/action/check-list.php" method="post">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h3 class="uk-modal-title">Check List</h3>
        </div>
        <div class="uk-modal-body">
            <input id="check-bind-todo-id" type="hidden" name="id" value="" required>
            <p class="uk-margin-remove-top">Are you sure want to check <span id="check-bind-todo" class="uk-text-bold"></span> in <span id="check-bind-list" class="uk-text-bold"></span> list?</p>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="submit">Yes, Check it</button>
        </div>
        </form>
    </div>
</div>