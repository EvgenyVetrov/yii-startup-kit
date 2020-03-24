<?php
/**
 * Вьюха страницы после успешной регистрации пользователя.
 * Запускается из zakupator2/common/modules/users/controllers/frontend/DefaultController.php
 * actionRegistration()
 *
 * User: evgeny
 * Date: 01.10.17
 * Time: 23:56
 */


Yii::$app->params['robots'] = 'none'; // не уверен что сработает тут
?>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
        <div class="card card-signup">
            <h2 class="card-title text-center">Регистрация завершена!</h2>
            <div class="row pl-sm-10 pr-sm-20">
                <div class="col-md-5 col-md-offset-1 col-sm-6">
                    <div class="card-content">
                        <div class="info info-horizontal">
                            <div class="icon icon-rose">
                                <i class="material-icons">location_city</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title mb-5">Формы организаций:</h4>
                            </div>
                            <div class="text-muted">

                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                <h4 class="panel-title">
                                                    Корпорация
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                Объединение нескольких юридических лиц в группу компаний под общим назваием (брендом).
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                <h4 class="panel-title">
                                                    Головная организация
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                Официальная организация, самостоятельно осуществляющая деятельность и/или управляющая дочерними организациями и филиалами.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <h4 class="panel-title">
                                                    Дочерняя организация
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                Формально самостоятельное юридическое лицо, организованное и/или подконтрольное другому юридическому лицу.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingEight">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                                <h4 class="panel-title">
                                                    Предприниматель
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                                            <div class="panel-body">
                                                Минимальная юридическая единица хозяйственной деятельности. Так же возможно адвокат или нотариус. ИП может иметь подчиненные организации/филиалы и вышестоящие.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingFour">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                <h4 class="panel-title">
                                                    Филиал / представительство
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                            <div class="panel-body">
                                                Cтруктурное подразделение, имеющее возможность самостоятельно принимать решения в рамках своих полномочий.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingFive">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                <h4 class="panel-title">
                                                    Дополнительный офис
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                            <div class="panel-body">
                                                Небольшая точка продаж или обособленный отдел, обладающий минимальной самостоятельностью.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingSix">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                <h4 class="panel-title">
                                                    Команда / бригада
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                            <div class="panel-body">
                                                Объединение специалистов смежных областей для комплексной работы (строители, IT специалисты, адвокаты...)
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingSeven">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                                <h4 class="panel-title">
                                                    Мастер / фрилансер
                                                    <i class="material-icons">keyboard_arrow_down</i>
                                                </h4>
                                            </a>
                                        </div>
                                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                                            <div class="panel-body">
                                                Самостоятельное неофициальное лицо (возможно с помощниками), специализирующееся на определенной деятельности.
                                            </div>
                                        </div>
                                    </div>
                                </div>



<!--                                <ul>
                                <li><strong>Корпорация</strong> (группа компаний) - объединение нескольких юридических лиц в группу компаний под общим назваием (брендом)</li>
                                <li><strong>Головная организация</strong> - официальная организация, самостоятельно осуществляющая деятельность или управляющая дочерними организациями и филиалами.</li>
                                <li><strong>Дочерняя организация</strong> - формально самостоятельное юридическое лицо, организованное и/или подконтрольное другому юр. лицу</li>
                                <li><strong>Филиал / представительство</strong> - структурное подразделение, имеющее возможность самостоятельно принимать решения в рамках своих полномочий.</li>
                                <li><strong>Доп. офис</strong> - небольшая точка продаж или обособленный отдел, обладающий минимальной самостоятельностью.</li>
                                <li><strong>Индивидуальный предприниматель</strong> - минимальная ячейка юрилических отношений. даже если у Вас есть дочернии организации и представительства.</li>
                                <li><strong>Команда / бригада</strong> - объединение специалистов смежных областей для комплексной работы (строители, IT специалисты, адвокаты...)</li>
                                <li><strong>Мастер / фрилансер</strong> - самостоятельное неофициальное лицо (возможно с помощниками), специализирующееся на определенной деятельности.</li>
                            </ul>
                            <p>Теперь можете добавить свою первую организацию. Организацией может быть объединение организаций
                                (корпорация), самостоятельная фирма, структурное подразделение, бригада (команда), мастер (фрилансер).
                                Связать структурное подразделение с головным офисом возможно после регистрации головного подразделения.</p>-->

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 pr-xs-30">


                    <div class="card-content pt-5">


                        <div class="alert alert-info alert-with-icon" data-notify="container">
                            <i class="material-icons" data-notify="icon">notifications</i>
                            <span data-notify="message">
                                <p>На текущий момент автор организации (Вы) является ее единственным управляющим. Вы можете создать несколько организаций.
                                    В ближайшее время мы добавим возможность добавлять других сотрудников организации с разными ролями.</p>
                            </span>
                        </div>

                        <p class="description">
                            Определитесь, какая форма организации ближе к вашей деятельности. Данную форму организации может увидеть потенциальный поставщик или покупатель.
                            Рекомендуем заполнить ее достоверно, для корректной работы некоторых функций системы и прозрачности взаимоотношений.
                        </p>


                    </div>
                    <div class="footer text-center">
                        <a href="/organisations/add" class="btn btn-primary btn-round">
                            <i class="material-icons">add_circle</i>&nbsp; Добавить организацию
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

