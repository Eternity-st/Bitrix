<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Регистрация пользователя");
$APPLICATION->SetAdditionalCSS("/local/templates/inblog/css/auth_register.css", true);

$arResult = $USER->Register($_POST['login'], $_POST['name'], $_POST['second_name'], $_POST['password'], $_POST['required-password'], $_POST['email']);
if ($_REQUEST == true)
    ShowMessage($arResult);

if ($USER->IsAuthorized()) {
    header('Location:/auth/personal.php');
}
?>
<form class="form-3" method="post" autocomplete="on">
    <div class="clearfix">
        <label for="login">Логин</label>
        <input type="text" name="login" value="" placeholder="Логин" required>
    </div>
    <div class="clearfix">
        <label for="name">Имя</label>
        <input type="text" name="name" placeholder="Имя" required>
    </div>
    <div class="clearfix">
        <label for="second_name">Фамилия</label>
        <input type="text" name="second_name" placeholder="Фамилия" required>
    </div>
    <div class="clearfix">
        <label for="password">Пароль</label>
        <input type="password" name="password" placeholder="Пароль" required>
    </div>
    <div class="clearfix">
        <label for="required-password"><br>Подтверждение пароля</label>
        <input type="password" name="required-password" placeholder="Пароль" required><br>
    </div>
    <div class="clearfix">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Email">
    </div>
    <div class="clearfix">
        <input type="submit" name="submit" value="Регистрация">
    </div>
</form>


<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>
