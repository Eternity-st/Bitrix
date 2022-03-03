<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle("Ауентификация");
$APPLICATION->SetAdditionalCSS("/local/templates/inblog/css/auth.css", true);
global $USER;

if (!is_object($USER))
    $USER = new CUser;
$arAuthResult = $USER->Login($_POST['login'], $_POST['password'], "Y");
$APPLICATION->arAuthResult = $arAuthResult;

if ($USER->IsAuthorized()) {
    header('Location:/news/');
}

?>
<form class="form-3" method="post" action="">
    <p class="clearfix">
        <label for="login">Логин</label>
        <input type="text" name="login" id="login" placeholder="Логин">
    </p>
    <p class="clearfix">
        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" placeholder="Пароль">
    </p>
    <p class="clearfix">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Запомнить меня</label>
    </p>
    <p class="clearfix">
        <input type="submit" name="submit" value="Войти">
    </p>
</form>

<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
?>
