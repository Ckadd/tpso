<footer class="row bg_footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-7 wrap_footer">
                <span>ลิขสิทธิ์ © 2559 กรมการท่องเที่ยว (Department of Tourism)</span>
                {!! PostService::listContentFooter()[0]['body'] ?? '' !!}
            </div>
            <div class="col-xs-12 col-sm-5">
                <div class="wrap_newsletter"><input type="text" name="newletter" data-url="{{route('newsletter.subscribe.addmail')}}" placeholder="{{__('subscribe_from_us')}}"><button class="btn_newsletter"></button></div>
                <div class="alert alert-success text-center alert-hide" id="footer-alert" style="margin:5px 0px;">
                    success
                </div>
                @php 
                    const visitorDefind = ( 3263770 - 79342 );
                @endphp
                <!-- {{ number_format(VisitorLogService::getCountLogs()) }} -->
                <div class="stat_footer">{{__('user_statistics')}}: {{ number_format( visitorDefind + VisitorLogService::getCountLogs()) }}</div>
                <!-- <div class="stat_footer">{{__('user_statistics')}}: 3,263,770</div> -->
                <div class="stat_footer">สถิติผู้เข้าใช้งานเว็บไซต์วันนี้: {{ number_format(VisitorLogService::getLogsToday()) }}</div>
                <div class="img_footer">
                    <img src="{{ ThemeService::path('assets/images/ipv6.png') }}"><img src="{{ ThemeService::path('assets/images/achecker.png') }}"><img src="{{ ThemeService::path('assets/images/callcenter.png') }}">
                </div>
            </div>
        </div>
    </div>
</footer>
@push('scripts')
<script>
    $(document).ready(function(){
        $('button.btn_newsletter').click(function(){
        if($('#footer-alert').not('.alert-hide')) {
            $('#footer-alert').addClass('alert-hide');
        }
        
        var newletter = $('input[name="newletter"]').val();
        var url = $('input[name="newletter"]').data('url');

        console.log(newletter);
            $.ajax({
                type:'GET',
                url:url,
                data:{newLetter:newletter},
                success:function(msg){
                console.log(msg);
                if(msg=="success") {
                    $('input[name="newletter"]').val('');
                    
                    $('#footer-alert').removeClass('alert-hide');
                }
                }
            });
        });
    });
</script>
@endpush