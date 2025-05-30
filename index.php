<!-- <!DOCTYPE html> -->
<?php
session_start();
setcookie('auth_token', '', time(), '/', '', false, true);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./styles/index.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <main class="container">
        <div class="parentDivForm">
            <div class="childDivForm">
                <form id="formLogin" action="src/views/login.php" method="POST" autocomplete="off" enctype="application/x-www-form-urlencoded">
                    <section class="sectionForm">
                        <div class="btnsLogin">
                            <button data-src="login" data-article="fieldsLogin" name="login" class="titleLogin lineBtn">Login</button>
                            <button data-src="register" data-article="fieldsSignUp" name="signUp" class="titleSignUp">Sign Up</button>
                        </div>
                        <article class="parentInputs fieldsLogin">
                            <label>
                                USERNAME
                                <input
                                    min="8" max="20"
                                    autocomplete="username"
                                    pattern="^(?=[^_]*_?[^_]*$)[a-zA-Z0-9._]{8,20}$" title="username" class="usernameLogin fieldLogin" id="username" name="username" type="text" />
                                <p class="messageUsername">
                                <p>
                            </label>
                            <label>
                                PASSWORD
                                <div class="parentInputPassword">
                                    <input
                                        min="15" max="20"
                                        pattern="^(?=[^_]*_?[^_]*$)[a-zA-z_&][a-zA-Z0-9_]{15,20}$"
                                        title="password" class="passwordLogin fieldLogin" id="password" name="password" type="password" />
                                    <button type="button" class="iconEyes">
                                        <span class="material-symbols-outlined">visibility</span>
                                        <span class="iconNone material-symbols-outlined">visibility_off</span>
                                    </button>
                                </div>
                                <p class="messagePass"></p>
                            </label>
                        </article>
                        <article class="parentHidden parentInputs fieldsSignUp">
                            <label>
                                REPEAT PASSWORD
                                <div class="parentInputPassword">
                                    <input  min="15" max="20" pattern="^(?=[^_]*_?[^_]*$)[a-zA-Z0-9_]{15,20}$" title="password repeat" id="passwordRepeat" name="repeatPassword" class="passwordSignUp fieldSignUp" type="password" />
                                    <button type="button" class="iconEyes">
                                        <span class="material-symbols-outlined">visibility</span>
                                        <span class="iconNone material-symbols-outlined">visibility_off</span>
                                    </button>
                                </div>
                                <p class="messagePassRepeat"></p>
                            </label>
                            <label>
                                EMAIL
                                <input min="5" max="20" pattern="^(?=[^_]*_?[^_]*$)[a-zA-Z0-9._]{5,20}@gmail\.com$" title="email" id="emailSignUp" class="emailSignUp fieldSignUp" name="email" type="email" />
                                <p class="messageEmail"></p>
                            </label>
                        </article>
                        <button id="btnSubmit" type="submit">Submit</button>
                    </section>
                </form>
            </div>
        </div>
    </main>
<script type="module" src="./home.js"></script>
</body>
</html>