<div class="uk-container uk-margin-medium-top">
    <div uk-grid>
        <div class="uk-width-1-1"><?= $alert ?></div>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body uk-padding-medium">
                <div class="uk-clearfix">
                    <div class="uk-float-left">
                        <div class="uk-inline">
                            <button class="uk-button uk-button-default btn-white"><?= $cat == NULL ? 'Select Category' : $categoriesClass->detail($cat)->name ?></button>
                            <div uk-dropdown>
                            <ul class="uk-nav uk-dropdown-nav">
                                <?php
                                    if ($fetchCategories):
                                        foreach ($fetchCategories as $category):
                                ?>
                                <li><a href="index.php?page=dashboard&cat=<?= $category->id ?>"><?= $category->name ?></a></li>
                                <?php
                                        endforeach;
                                    else:
                                ?>
                                <li><a href="#">There is no category found</a></li>
                                <?php
                                    endif;
                                ?>
                            </ul>
                        </div>
                        </div>
                        <button class="uk-button uk-button-primary" uk-toggle="target: #modal-add-category"><span uk-icon="plus"></span> Add Category</button>
                    </div>

                    <div class="uk-float-right">
                        <button class="uk-button uk-button-primary" uk-toggle="target: #modal-add-list"><span uk-icon="pencil"></span> Add List</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
            if ($assign == NULL):
        ?>

        <div class="uk-width-1-3">
            <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                    <h3 class="uk-text-center">Today</h3>
                </div>
                <div class="uk-card-body">
                    <?php
                        if ($fetchTodayLists):
                    ?>
                    <ul class="uk-list uk-list-divider">
                    <?php
                            foreach ($fetchTodayLists as $todayList):
                    ?>
                        <li>
                            <div class="uk-clearfix">
                                <div class="uk-float-left">
                                    <?= $todayList->status == 1 ? '<span class="strike">' . $todayList->todo . '</span>' : shortDescription($todayList->todo) ?>
                                </div>
                                <div class="uk-float-right">
                                    <a href="" class="" uk-icon="icon: folder" uk-tooltip="<?= $todayList->categories_name ?>"></a> 
                                    <?php
                                        if ($todayList->status != 1):
                                    ?>
                                    <a href="" class="btn-check-list uk-text-success" uk-icon="icon: check" uk-toggle="target: #modal-check-list" data-bind-id="<?= $todayList->id ?>" data-bind-todo="<?= $todayList->todo ?>" data-bind-list="Today"></a> 
                                    <?php endif; ?>
                                    <a href="" class="btn-delete-list uk-text-danger" uk-icon="icon: close" uk-toggle="target: #modal-delete-list" data-bind-id="<?= $todayList->id ?>" data-bind-todo="<?= $todayList->todo ?>" data-bind-list="Today"></a>
                                </div>
                            </div>
                        </li>
                    <?php
                            endforeach;
                    ?>
                    </ul>
                    <?php
                        else:
                    ?>
                    <div class="uk-alert-primary" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>You have no todo list for today.</p>
                    </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                    <h3 class="uk-text-center">Tomorrow</h3>
                </div>
                <div class="uk-card-body">
                <?php
                        if ($fetchTomorrowLists):
                    ?>
                    <ul class="uk-list uk-list-divider">
                    <?php
                            foreach ($fetchTomorrowLists as $tomorrowList):
                    ?>
                        <li>
                            <div class="uk-clearfix">
                                <div class="uk-float-left">
                                    <?= $tomorrowList->status == 1 ? '<span class="strike">' . $tomorrowList->todo . '</span>' : shortDescription($tomorrowList->todo) ?>
                                </div>
                                <div class="uk-float-right">
                                    <a href="" class="" uk-icon="icon: folder" uk-tooltip="<?= $tomorrowList->categories_name ?>"></a> 
                                    <?php
                                        if ($tomorrowList->status != 1):
                                    ?>
                                    <a href="" class="btn-check-list uk-text-success" uk-icon="icon: check" uk-toggle="target: #modal-check-list" data-bind-id="<?= $tomorrowList->id ?>" data-bind-todo="<?= $tomorrowList->todo ?>" data-bind-list="Tomorrow"></a> 
                                    <?php endif; ?>
                                    <a href="" class="btn-delete-list uk-text-danger" uk-icon="icon: close" uk-toggle="target: #modal-delete-list" data-bind-id="<?= $tomorrowList->id ?>" data-bind-todo="<?= $tomorrowList->todo ?>" data-bind-list="Tomorrow"></a>
                                </div>
                            </div>
                        </li>
                    <?php
                            endforeach;
                    ?>
                    </ul>
                    <?php
                        else:
                    ?>
                        <div class="uk-alert-primary" uk-alert>
                            <a class="uk-alert-close" uk-close></a>
                            <p>You have no todo list for tomorrow.</p>
                        </div>
                    <?php
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                    <h3 class="uk-text-center">Upcoming</h3>
                </div>
                <div class="uk-card-body">
                    <?php
                            if ($fetchUpcomingLists):
                        ?>
                        <ul class="uk-list uk-list-divider">
                        <?php
                                foreach ($fetchUpcomingLists as $upcomingList):
                        ?>
                            <li>
                                <div class="uk-clearfix">
                                    <div class="uk-float-left">
                                        <?= $upcomingList->status == 1 ? '<span class="strike">' . $upcomingList->todo . '</span>' : shortDescription($upcomingList->todo) ?>
                                    </div>
                                    <div class="uk-float-right">
                                        <a href="" class="" uk-icon="icon: folder" uk-tooltip="<?= $upcomingList->categories_name ?>"></a> 
                                        <?php
                                            if ($upcomingList->status != 1):
                                        ?>
                                        <a href="" class="btn-check-list uk-text-success" uk-icon="icon: check" uk-toggle="target: #modal-check-list" data-bind-id="<?= $upcomingList->id ?>" data-bind-todo="<?= $upcomingList->todo ?>" data-bind-list="Upcoming"></a> 
                                        <?php endif; ?>
                                        <a href="" class="btn-delete-list uk-text-danger" uk-icon="icon: close" uk-toggle="target: #modal-delete-list" data-bind-id="<?= $upcomingList->id ?>" data-bind-todo="<?= $upcomingList->todo ?>" data-bind-list="Upcoming"></a>
                                    </div>
                                </div>
                            </li>
                        <?php
                                endforeach;
                        ?>
                        </ul>
                        <?php
                            else:
                        ?>
                            <div class="uk-alert-primary" uk-alert>
                                <a class="uk-alert-close" uk-close></a>
                                <p>You have no upcoming todo list.</p>
                            </div>
                        <?php
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            else:
        ?>
        <div class="uk-width-1-1">
            <div class="uk-clearfix">
                <div class="uk-float-left">
                    <h4><?= strtoupper($assign) ?> LISTS</h4>
                </div>
                <div class="uk-float-right">
                    Total <?= $fetchLists != true ? '0' : count($fetchLists) ?> list(s)
                </div>
            </div>
        </div>
    </div>
    <div uk-grid="masonry: true">
        <?php
                if ($fetchLists):
                    foreach ($fetchLists as $list):
        ?>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-small uk-card-default">
                <div class="uk-card-body">
                    <span class="uk-label"><?= $list->categories_name ?></span>
                    <?= $list->status == 1 ? '<p class="strike">' . $list->todo . '</p>' : '<p>' . $list->todo . '</p>' ?>
                </div>
                <div class="uk-card-footer uk-padding-remove">
                    <div class="uk-button-group" style="width: 100%">
                        <?php
                            if ($list->status != 1):
                        ?>
                        <button class="uk-button uk-button-primary uk-button-small btn-check-list uk-width-1-2" uk-toggle="target: #modal-check-list" data-bind-id="<?= $list->id ?>" data-bind-todo="<?= $list->todo ?>" data-bind-list="<?= ucwords($assign) ?>"><span uk-icon="icon: check"></span> Check</button>
                        <?php endif; ?>
                        <button class="uk-button uk-button-danger uk-button-small btn-delete-list <?= $list->status != 1 ? 'uk-width-1-2' : 'uk-width-1-1' ?>" uk-toggle="target: #modal-check-list" data-bind-id="<?= $list->id ?>" data-bind-todo="<?= $list->todo ?>" data-bind-list="<?= ucwords($assign) ?>"><span uk-icon="icon: close"></span> Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
                    endforeach;
                else:
        ?>
        <div class="uk-width-1-1">
            <div class="uk-alert-primary" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <p>You have no todo list.</p>
            </div>
        </div>
        <?php
                endif;
            endif;
        ?>
    </div>
</div>