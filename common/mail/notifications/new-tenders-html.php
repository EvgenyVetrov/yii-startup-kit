<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $activateUrl string
 * @var $notifications
 */

$domain = Url::to(['/'], true);
?>
<style>
    .text-bbb {
        color: #bbbbbb;
    }
</style>

<table id="bodyTable"
       style="border-collapse:collapse; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5"
       width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff" border="0">
    <tbody>
    <tr style="border-color:transparent">
        <td border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:transparent">
            <table
                style="border-collapse:collapse; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; width:100%"
                width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <tr style="border-color:transparent">
                    <th style="border-color:transparent; font-weight:400; text-align:left; vertical-align:top"
                        cellpadding="0" cellspacing="0" class="tc" width="600" valign="top" align="left">
                        <table
                            style="border-collapse:collapse; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; background-color:#3C4858"
                            width="100%" cellspacing="0" cellpadding="0" bgcolor="#3C4858" border="0">
                            <tbody>
                            <tr style="border-color:transparent">
                                <td cellpadding="0" cellspacing="0"
                                    style="border-collapse:collapse; border-color:transparent">
                                    <table id="w"
                                           style="border-collapse:collapse; color:#fff; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; background-color:#3C4858; font-weight:normal; margin:0; text-color:black"
                                           width="100%" cellspacing="0" cellpadding="0" bgcolor="#3C4858">
                                        <tbody>
                                        <tr style="border-color:transparent">
                                            <td class="expander" colspan="3"
                                                style="border-collapse:collapse; border-color:transparent" width="100%"
                                                height="30"></td>
                                        </tr>
                                        <tr style="border-color:transparent;">
                                            <td class="gutter"
                                                style="border-collapse:collapse; border-color:transparent" width="30"
                                                height="100%"></td>
                                            <td class="content-cell"
                                                <p style="display:block; font-size:inherit; line-height:inherit; margin:0 0 10px; color:#fff; font-family:Georgia, 'Times New Roman', Times, serif; width:100%; font-weight:normal; padding:0; text-align:center"
                                                   width="100%" align="center"><span
                                                        style="font-family: 'book antiqua', palatino, serif; color: #ffffff;">Сервис формирования требований и публикации закупок</span>
                                                </p></td>
                                            <td class="gutter"
                                                style="border-collapse:collapse; border-color:transparent" width="30"
                                                height="100%"></td>
                                        </tr>
                                        <tr style="border-color:transparent">
                                            <td class="expander" colspan="3"
                                                style="border-collapse:collapse; border-color:transparent" width="100%"
                                                height="0"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr style="border-color:transparent">
        <td border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:transparent">
            <table
                style="border-collapse:collapse; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; width:100%"
                width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <tr style="border-color:transparent">
                    <th style="background-color: #3C4858; border-color:transparent; font-weight:400; text-align:left; vertical-align:top"
                        cellpadding="0" cellspacing="0" class="tc" width="600" valign="top" align="left">
                        <table
                            style="border-collapse:collapse; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; background-color:#eee"
                            width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr style="border-color:transparent">
                                <td cellpadding="0" cellspacing="0"
                                    style="background-color: #3C4858; border-collapse:collapse; border-color:transparent">
                                    <table id="w"
                                           style="max-width: 600px; margin: auto; background-color: #fff; border-collapse:collapse; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; font-weight:normal; text-color:black"
                                           width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr style="border-color:transparent">
                                            <td class="expander" colspan="3"
                                                style="border-collapse:collapse; border-color:transparent" width="100%"
                                                height="30"></td>
                                        </tr>
                                        <tr style="border-color:transparent">
                                            <td class="gutter"
                                                style="border-collapse:collapse; border-color:transparent" width="30"
                                                height="100%"></td>
                                            <td class="content-cell"
                                                style="border-collapse:collapse; border-color:transparent; vertical-align:top"
                                                width="540" valign="top"><h3
                                                    style="font-weight:normal; line-height:1.5; margin:0 0 10px; font-size:24px; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; text-align:center"
                                                    align="center"><strong><span
                                                            style="font-size: 20px;">Мониторинг #<?= $monitoring_id ?> обнаружил закупки:</span></strong></h3>


                                                <?= $this->render('_list', [
                                                        'notifications' => $notifications
                                                ]) ?>

                                            </td>
                                            <td class="gutter"
                                                style="border-collapse:collapse; border-color:transparent" width="30"
                                                height="100%"></td>
                                        </tr>
                                        <tr style="border-color:transparent">
                                            <td class="expander" colspan="3"
                                                style="border-collapse:collapse; border-color:transparent" width="100%"
                                                height="5"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr style="border-color:transparent">
        <td border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:transparent">
            <table
                style="border-collapse:collapse; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; width:100%"
                width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                <tr style="border-color:transparent">
                    <th style="border-color:transparent; font-weight:400; text-align:left; vertical-align:top"
                        cellpadding="0" cellspacing="0" class="tc" width="600" valign="top" align="left">
                        <table
                            style="border-collapse:collapse; color:#444; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; background-color:#3C4858"
                            width="100%" cellspacing="0" cellpadding="0" bgcolor="#3C4858" border="0">
                            <tbody>
                            <tr style="border-color:transparent">
                                <td cellpadding="0" cellspacing="0"
                                    style="border-collapse:collapse; border-color:transparent">
                                    <table id="w"
                                           style="border-collapse:collapse; color:#95b3ab; font-family:Georgia, 'Times New Roman', Times, serif; font-size:14px; line-height:1.5; background-color:#3C4858; font-weight:normal; margin:0; text-color:black"
                                           width="100%" cellspacing="0" cellpadding="0" bgcolor="#3C4858">
                                        <tbody>
                                        <tr style="border-color:transparent">
                                            <td class="expander" colspan="3"
                                                style="border-collapse:collapse; border-color:transparent" width="100%"
                                                height="0"></td>
                                        </tr>
                                        <tr style="border-color:transparent">
                                            <td class="gutter"
                                                style="border-collapse:collapse; border-color:transparent" width="30"
                                                height="100%"></td>
                                            <td class="content-cell"
                                                style="border-collapse:collapse; border-color:transparent; vertical-align:top"
                                                width="540" valign="top"><p
                                                    style="display:block; font-size:inherit; line-height:inherit; margin:0 0 10px; color:#95b3ab; font-family:Georgia, 'Times New Roman', Times, serif; width:100%; font-weight:normal; padding:0; text-align:center"
                                                    width="100%" align="center"><a href="https://zakupator.org"
                                                                                   target="_blank"
                                                                                   style="text-decoration:none; color:#00bfbf">©
                                                        zakupator.org</a></p></td>
                                            <td class="gutter"
                                                style="border-collapse:collapse; border-color:transparent" width="30"
                                                height="100%"></td>
                                        </tr>
                                        <tr style="border-color:transparent">
                                            <td class="expander" colspan="3"
                                                style="border-collapse:collapse; border-color:transparent" width="100%"
                                                height="0"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr style="border-color:transparent">
        <td border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border-color:transparent; text-align: center">
            Вы получили это письмо так как прошли регистрацию на сайте zakupator.org<br>
        </td>
    </tr>
    </tbody>
</table>