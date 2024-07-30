<?php

class UserController{

    public function control_login()
    {
        if (!empty($_POST['mail']) && !empty($_POST['password'])) {
            $mail = $_POST['mail'];
            $password = $_POST['password'];
            $verificar = UserModel::login($mail, $password);

            if ($verificar != false) {
                $mail_user = $verificar['email'];
                $id_user = $verificar['id_user'];
                $rol = $verificar['fk_rol_id'];
                $state = $verificar['state'];
    
                if ($state == 1) {
                    $_SESSION['state'] = $state;
                    $_SESSION['email'] = $mail_user;
                    $_SESSION['fk_rol_id'] = $rol;
                    $_SESSION['id_user'] = $id_user;
    
    
                    echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location="../index.php?pages=home";
                    </script>';
                }
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">Usuario o contraseña incorrecta</div>';
            }
        } else {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            alert("Debes completar los campos");
            </script>';
        }
    }

    static public function sessionDataUser($id)
    {
        $dataUser = UserModel::dataUser($id);
        return $dataUser;
    }
    
    static public function newUser()
    {
        if ((!empty($_POST['name'])) && (!empty($_POST['mail'])) && 
            (!empty($_POST['gender'])) && !empty($_POST['roles'])
            
        ) {

            $name = ucwords(strtolower(trim($_POST['name'])));
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u", $name)) {
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    </script>
                    <div class="col-sm-12 pt-3">
                        <div class="d-flex justify-content-center align-items-center">             
                            <div class="alert alert-danger mt-2">El nombre solo puede contener letras, espacios y tildes.</div>
                        </div>
                    </div>';
                return;
            }            

            if (strlen($name) > 100) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">El nombre no puede tener más de 100 caracteres.</div>
                    </div>
                </div>';
                return;
            }

            $email = strtolower(trim($_POST['mail']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email === false) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">Email inválido.</div>
                    </div>
                </div>';
                return;
            }

            if (strlen($email) > 100) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">El email no puede tener más de 100 caracteres.</div>
                    </div>
                </div>';
                return;
            }

            $gender = $_POST['gender'];
            $roles = $_POST['roles'];

            $password = "probandoEntrenamiento";
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $checkCountEmail = UserModel::checkExistingEmail($email);
            if ($checkCountEmail !== false) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">Ya existe el email.</div>
                    </div>
                </div>';
            } else {
                $execute = UserModel::newUser($name, $email, $hashedPassword, $roles, $gender);
                if ($execute) {
                    echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    
                    window.location="../index.php?pages=manageUser&subfolder=newUser&message=correcto";
                    </script>
                    <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-succes mt-2">Se guardó el registro correctamente</div>
                    </div>
                </div>';
                } else {
                    echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location="../index.php?pages=manageUser&subfolder=newUser";
                    </script>
                    <div class="col-sm-12 pt-3">
                        <div class="d-flex justify-content-center align-items-center">             
                            <div class="alert alert-danger mt-2">Hubo un problema al crearlo</div>
                        </div>
                    </div>';
                }
            }
        } else {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                <div class="d-flex justify-content-center align-items-center">             
                    <div class="alert alert-danger mt-2">Debes completar los campos</div>
                </div>
            </div>';
        }
    }

    static public function getAllUser()
    {
        return UserModel::getAllUser();
    }

    static public function disableAccountUser()
    {
        if (isset($_GET['id_user'])) { 
            $id = $_GET['id_user']; 
            $execute = UserModel::disableUser($id); 

            if ($execute) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                
                window.location="../index.php?pages=manageUser";
                </script>
                <div class="alert alert-success mt-2">Se deshabilitó la cuenta.</div>'; 
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">No se pudo deshabilitar.</div>'; 
            }
        }
    }

    static public function enableAccountUser()
    {
        if (isset($_GET['id_user'])) { 
            $id = $_GET['id_user']; 
            $execute = UserModel::activateUser($id); 

            if ($execute) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                
                window.location="../index.php?pages=manageUser&subfolder=listUser";
                </script>
                <div class="alert alert-success mt-2">Cuenta habilitada.</div>';
            } else {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="alert alert-danger mt-2">No se pudo habilitar.</div>';
            }
        }
    }

    static public function editarUser()
    {
        $name = ucwords(strtolower(trim($_POST['name'])));
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$/u", $name)) {
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">El nombre solo puede contener letras, espacios y tildes.</div>
                    </div>
                </div>';
            return;
        }            

        if (strlen($name) > 100) {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                <div class="d-flex justify-content-center align-items-center">             
                    <div class="alert alert-danger mt-2">El nombre no puede tener más de 100 caracteres.</div>
                </div>
            </div>';
            return;
        }

        $roles = $_POST['roles'];
        $id = $_POST['id_user'];
        $gender = $_POST['gender'];
        $email = strtolower(trim($_POST['mail']));
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        if ($email === false) {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                <div class="d-flex justify-content-center align-items-center">             
                    <div class="alert alert-danger mt-2">Email inválido.</div>
                </div>
            </div>';
            return;
        }

        $checkCountEmail = UserModel::checkExistingEmailWhileEditing($id, $email);
        if ($checkCountEmail !== false) {
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
            </script>
            <div class="col-sm-12 pt-3">
                <div class="d-flex justify-content-center align-items-center">             
                    <div class="alert alert-danger mt-2">Ya existe el email.</div>
                </div>
            </div>';
            return;
        }

        $execute = UserModel::updateUserData($name, $roles, $id, $gender, $email);
        if ($execute) {
            echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }

                    window.location="../index.php?pages=manageUser&subfolder=listUser&message=correcto";
                    </script>
                    <div class="alert alert-succes mt-2">Se editó correctamente.</div>';
        } else {
            echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    window.location="../index.php?pages=manageUser&subfolder=listUser";
                    </script>
                    <div class="alert alert-danger mt-2">Hubo un problema al editarlo.</div>';
        }
    }

    static public function newPassword()
    {
        if (!empty($_POST['currentPassword']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            if ($newPassword !== $confirmPassword) {
                echo '<div class="alert alert-danger mt-2">Las contraseñas nuevas no coinciden.</div>';
                return;
            }

            if (strlen($newPassword) < 8) {
                echo '<div class="alert alert-danger mt-2">La nueva contraseña debe tener al menos 8 caracteres.</div>';
                return;
            }

            if(strlen($newPassword) > 100 || strlen($confirmPassword) > 100) {
                echo '<div class="alert alert-danger mt-2">La contraseña no puede tener más de 100 caracteres.</div>';
                return;
            }

            // Obtener la contraseña actual del usuario
            $verifyPassword = UserModel::getPassword($_SESSION['id_user']);
            $oldPassword = $verifyPassword['password'];

            // Verificar si la contraseña actual es correcta
            if (password_verify($currentPassword, $oldPassword)) {

                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $result = UserModel::updatePassword($_SESSION['id_user'], $hashedPassword);

                if ($result) {
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Cambiada!",
                        text: "La contraseña se ha cambiado.",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php?pages=changePassword";
                        }
                    });
                    </script>';
                } else {
                    echo '<div class="alert alert-danger mt-2">Error al actualizar la contraseña. Por favor, inténtalo de nuevo más tarde.</div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-2">La contraseña actual es incorrecta.</div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-2">Por favor, completa todos los campos.</div>';
        }
    }


}


?>