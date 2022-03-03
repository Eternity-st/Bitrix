<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Профиль");
$APPLICATION->SetAdditionalCSS("/local/templates/inblog/css/personal_page.css", true);

global $USER;

AddSubs($USER->GetID());

$arrGroup = [];
foreach ($USER->GetUserGroupArray() as $key => $groupId) {
    $key = CGroup::GetByID($groupId)->Fetch()['NAME'];
    $arrGroup[$key] = $groupId;
}

$photoID = CUser::GetByID($USER->GetID())->Fetch()['PERSONAL_PHOTO'];

if ($USER->IsAuthorized()): ?>
    <form method="post">
        <div class="flex-container">
            <div class="flex-item dark">

                <img alt class="avatar" src="<?
                if (($photoID['PERSONAL_PHOTO']) == true) :
                    echo $photoPath = CFile::GetPath($photoID);
                else:
                    echo "/local/templates/inblog/img/anon.jpg";
                endif; ?>"><br>
                <label>В данный момент:</label>
                <H4 id="text">
                    <strong>
                        <? if (CUser::IsOnLine($USER->GetID())):
                            echo "В сети";
                        else:
                            echo "Был(а)" . " " . CUser::SetLastActivityDate($USER->GetID()) . " " . "секунд(у) назад";
                        endif; ?>
                    </strong>
                </H4><br>

                <div id="dark">
                    <ul class="btn-list normal">
                        <li><a href="" class="btn-gradient facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="" class="btn-gradient twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="<?
                            $rsUser = CUser::GetByID($USER->GetID());
                            $arUser = $rsUser->Fetch();
                            echo $arUser["UF_INSTAGRAM"]; ?>" class="btn-gradient instagram">
                                <i class="fa fa-instagram"></i></a></li>
                        <li><a href="" class="btn-gradient github"><i class="fa fa-github"></i></a></li>
                        <li>
                            <a href="<?= CUser::GetList('', '', ['ID' => $USER->GetID()], [])->Fetch()['PERSONAL_MAILBOX'] ?>"
                               class="btn-gradient gmail"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                    <label> Текущая Дата:</label>
                    <div>
                        <script src="/local/templates/inblog/js/date.js"></script>
                    </div>
                </div>
            </div>
            <div class="flex-item dark flex-item1">
                <label>Фио:</label>
                <div class="bubble">
                    <?= $USER->GetFullName(); ?>
                </div>
                <label>Email:</label>
                <div class="bubble">
                    <?= $USER->GetEmail(); ?>
                </div>
                <label>Группы пользователя:</label>
                <div class="groups bubble">
                    <?php foreach ($arrGroup as $name => $id):
                        if ($id !== '2'):
                            echo $name . '<br>';
                        endif; endforeach; ?>
                </div>
                <label> Номер телефона:</label>
                <div class="bubble">
                    <?= $user = CUser::GetList('', '', ['ID' => $USER->GetID()], [])->Fetch()['PERSONAL_PHONE']; ?>
                </div>
            </div>
            <div class="flex-item dark flex-item-subs">
                <?
                if (in_array('6', $arrGroup)) :
                    echo '<label>Вы подписаны</label>';
                else :
                    echo '<label>Подпишитесь с нами гораздо уютнее</label>';
                endif;
                ?>
                <input type="submit" class="bubble" name="sub"
                       value="<?= (in_array(6, $arrGroup)) ? 'отписаться' : 'Подписаться' ?>">
            </div>
    </form>
    <script>
        function change() {
            re = "rgb(" + Math.round(Math.random() * 256) + "," + Math.round(Math.random() * 256) + "," + Math.round(Math.random() * 256) + ")";
            text.style.color = re;
        }

        setInterval(change, 500);
    </script>
<? else :
    echo '<pre>';
    echo 'Пользователь не авторизован';
    echo '</pre>';
    ?>
<? endif; ?>
<?
$arFields = Array();
?>
<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>