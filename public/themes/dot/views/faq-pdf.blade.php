<!DOCTYPE html>
<html>
<head>
    <title>{{__('title_department_of_tourism')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src:url("{{ public_path('themes/dot/assets/fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src:url("{{ public_path('themes/dot/assets/fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src:url("{{ public_path('themes/dot/assets/fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src:url("{{ public_path('themes/dot/assets/fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
        body {
            font-family:"THSarabunNew";
        }
        .border_tab{
            border: 1px solid #d7d7d7;
            margin-bottom: 18px;
        }
        .tab_item{
            font-weight: 500;
            padding-top: 10px;
            border-bottom: 4px solid #8ed6d7;
            padding-left: 15px;
            padding-right: 15px;
            cursor: pointer;
        }
        .tab_item.active{
            background-color: #8ed6d7;
        }
        .tab_head{
            display: inline-block;
            width: calc(100% - 60px);
            padding-left: 15px;
            padding-right: 10px;
            line-height: 1;
            font-size: 1.25rem;
            vertical-align: middle;
            color: #000;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .tab_detail{
            display: block;
            padding: 30px;
            margin-bottom: 15px;
        }
        .tab_detail p{
            color: #646363;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <img src="{{ public_path('themes/dot/assets/images/dotlogo.png') }}">
    <h2>{{__('menu_frequently_asked_questions')}}</h2>
    <div class="border_tab">
        <div class="tab_item">
            <div class="tab_num"></div><div class="tab_head">
                {!! $data['title'] ?? '' !!} 
            </div>
        </div>
        <div class="tab_detail">
            {!! $data['content'] ?? '' !!}
        </div>
    </div>
</body>
</html>