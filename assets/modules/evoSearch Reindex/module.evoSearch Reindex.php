<?php
/**
 * evoSearch Reindex
 *
 * reindex resources for evoSearch
 *
 * @category        parser
 * @version         0.1
 * @author          hkyss
 * @documentation   empty
 * @lastupdate      09.11.2020
 * @internal    	@modx_category Search
 * @license         GNU General Public License (GPL), http://www.gnu.org/copyleft/gpl.html
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>Переиндексация товаров</title>
    <link rel="stylesheet" type="text/css" href="media/style/default/style.css" />
    <link rel="stylesheet" href="media/style/common/font-awesome/css/font-awesome.min.css" />
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        function Reindex(start=0,step=100,arr_count=0) {
            let answer = document.querySelector('.answer--server');
            $.ajax(
                {
                    type: 'POST',
                    dataType: 'json',
                    url: '/reindex',
                    data: {start:start,step:step},
                    success: function (data)
                    {
                        console.log(data);
                        if(data.start < data.arr_count) {
                            $('.message--process').remove();
                            $('.answer--server').append('<div class="message message--process"><span class="process">PROCESS</span>: Переиндексировано ' + data.start + ' из ' + data.arr_count + '</div>');
                            answer.scrollTop = answer.scrollHeight;
                            setTimeout(function(){
                                Reindex(data.start,step,data.arr_count);
                            },1000);
                        }
                        else {
                            $('.message--process').remove();
                            $('.answer--server').append('<div class="message"><span class="success">SUCCESS</span>: Переиндексировано ' + data.arr_count + ' товаров.</div>');
                            answer.scrollTop = answer.scrollHeight;
                            setTimeout(function(){
                                alert('Переиндексация выполнена.');
                            },500);
                        }
                    },
                    error: function (data)
                    {
                        console.log('AjaxLoad error.');
                        console.log(data);
                    }
                }
            );
        }

        function StartReindex() {
            let confirmed = confirm('Хотите выполнить переиндексацию?');
            if(confirmed === true) {
                Reindex();
            }
        }
    </script>

    <style>
        .answer {
            padding: .8rem
        }
        .answer--title {
            font-size: 1em;
            line-height: 1rem;
            margin-bottom: 10px;
        }
        .answer--server {
            padding: .5rem;
            border: 1px solid #ddd;
            background-color: #F2F2F2;
            font-size: .9em;
            line-height: .9rem;
            max-height: 80vh;
            overflow-y: scroll;
        }
        .message {
            margin-bottom: .5rem;
        }
        .message:last-child {
            margin-bottom: 0;
        }
        .success {
            color: #5cb85c;
        }
        .error {
            color: #a52a2a;
        }
    </style>
</head>
<body>
<h1 class="pagetitle">
			<span class="pagetitle-icon">
				<i class="fa fa-file-text"></i>
			</span>
    <span class="pagetitle-text">
				Переиндексация товаров
			</span>
</h1>
<div id="actions">
    <ul class="actionButtons">
        <li id="reindex"><a href="#" onclick="StartReindex();">Запустить</a></li>
    </ul>
</div>
<div class="answer">
    <div class="answer--title">Ответ сервера:</div>
    <div class="answer--server">
        <div class="message"><span class="success">SUCCESS</span>: Модуль переиндексации готов к работе.</div>
    </div>
</div>
</body>
</html>