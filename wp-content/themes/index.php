@extends('master')
@section('content')
<body id="wrapper" class="ld_page_com ld_page_user">
<header>
    <div class="flexrowbetween hdtop main">
        <div class="logo"><a href="../"><img src="{{url('images/common_img/logoLPuser.png')}}" alt="スマオク！ 競争見積り オークション 業界初!？ 中古車買取のビッグバンサイト！"></a></div>
        <div class="txt_right clearfix dis_pc">
            <p class="text_right">お電話での価格チェックをご希望の方</p>
            <p class="mt10 teltop"><a href="tel:06-7670-7744"><img src="{{url('images/user/txttelhd.png')}}" alt="tel:06-7670-7744"></a></p>
        </div>
        <div class="icontel">
            <p class="dis_sp"><a href="tel:06-7670-7744"><img src="{{url('images/user/icontel_hd.png')}}" alt="tel:06-7670-7744"></a></p>
        </div>
    </div>
</header>
<!-- End Top-->
<section>
    <div class="banner">
        <h2 class="dis_sp"><img src="{{url('images/user/banner_sp.png')}}" alt="オークション&競争見積りだから あなたの愛車がどこよりも高く売れる！"></h2>
        <h2 class="dis_pc text_center"><img src="{{url('images/user/banner_sp.png')}}" alt="オークション&競争見積りだから あなたの愛車がどこよりも高く売れる！"></h2>
    </div>
    <article class="boxdis_pc">
        <form id="FormRegisterSeller1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            {{ csrf_field() }}
            <div class="boxteltop">
                <h3 class="dis_pc text_center"><img src="{{url('images/user/titboxtel.png')}}" alt="あなたの愛車、とりあえず価格だけチェック！"></h3>
                <h3 class="dis_sp text_center"><img src="{{url('images/user/titboxtel_sp.png')}}" alt="あなたの愛車、とりあえず価格だけチェック！"></h3>
                <div class="tbbox">
                    <table class="tbstyle">
                        <tr>
                            <th><span class="hinsu">必須</span> メーカー</th>
                            <td><select name="seller_maker" id="seller_maker">
                                    <option value=""></option>
                                    @foreach($list_makers as $makers)
                                    <option value="{{ $makers->id }}">{{ $makers->name }}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        <tr>
                            <th><span class="hinsu">必須</span> 車種</th>
                            <td><select name="seller_car_type" id="seller_car_type">
                                    <option value=""></option>
                                    @foreach($list_cars as $cars)
                                    <option value="{{ $cars->id }}" class="car-{{ $cars->maker_id }} car" style="display: none">{{ $cars->name }}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        <tr>
                            <th><span class="ninni">任意</span> 年式</th>
                            <td><input type="text" value="" name="seller_date" id="seller_date" size="" tabindex="" accesskey="" placeholder=""></td>
                        </tr>
                        <tr>
                            <th><span class="ninni">任意</span> 走行距離</th>
                            <td><input type="text" value="" name="seller_mileage" id="seller_mileage" size="" tabindex="" accesskey="" placeholder=""></td>
                        </tr>
                    </table>
                    <table class="tbstyle">
                        <tr>
                            <th><span class="hinsu">必須</span> TEL</th>
                            <td><input type="text" value="" name="seller_tel" id="seller_tel" size="" tabindex="" accesskey="" placeholder="例）09012345678" ></td>
                        </tr>
                        <tr>
                            <th><span class="hinsu">必須</span> 名前</th>
                            <td><input type="text" value="" name="seller_name" id="seller_name" size="" tabindex="" accesskey="" placeholder="例）山田　太郎"></td>
                        </tr>
                        <tr>
                            <th><span class="ninni">任意</span> 都道府県</th>
                            <td><select name="seller_zone" id="seller_zone">
                                    <option value=""></option>
                                    @foreach($list_zones as $zones)
                                    <option value="{{ $zones->id }}">{{ $zones->name }}</option>
                                    @endforeach
                                </select></td>
                        </tr>
                        <tr>
                            <th><span class="ninni">任意</span> メール</th>
                            <td><input type="text" value="" name="seller_email" id="seller_email" size="" tabindex="" accesskey="" placeholder="例）yamada@smart.com"></td>
                        </tr>
                    </table>
                </div>
                <div class="boxbtn_tel">
                    <div class="txt">
                        <p>お電話での価格査定をご希望の方</p>
                        <p class="dis_pc"><img src="{{url('images/user/txttelhd.png')}}" alt="tel:06-7670-7744"></p>
                        <p class="dis_sp"><a href="tel:06-7670-7744"><img src="{{url('images/user/txttelhd.png')}}" alt="tel:06-7670-7744"></a></p>
                    </div>
                    <div><p class="btn"><button type="submit" id="submit1" style="padding:0; border: none; cursor: pointer;"><img src="{{url('images/user/btn1.png')}}" alt="無料登録をする"></button></p></div>
                </div>
            </div>
        </form>
    </article>
</section>
<!-- end content_secon -->
<h2 class="text_center bgtit1"><img src="{{url('images/user/tit1.png')}}" alt="スマオク！のメリットって？"></h2>
<p class="dis_sp lh00"><img src="{{url('images/user/bgline1_sp.png')}}" alt=""></p>
<section class="section1">
    <article class="flexrowbetween">
        <div class="medal">
            <img src="{{url('')}}/images/user/medal1.png" alt="競争見積り＆ｵｰｸｼｮﾝ">
            <p>出品者は全て一般ユーザのみ。つまり中古車取引の際に時折見られる悪質な業社のメータ改ざん、部品抜き取り等のリスクが相当に激減されます！</p>
        </div>
        <div class="medal">
            <img src="{{url('')}}/images/user/medal2.png" alt="あちこちから連絡が来ない">
            <p>通常「ユーザ」→「買取業者」→「オークション」→「中古車販売業社」の流れですが、スマオク！はユーザ直出品。だから買取業者の中間マージンがゼロなため、安く落札できるのです。</p>
        </div>
        <div class="medal">
            <img src="{{url('')}}/images/user/medal3.png" alt="一番高い業社を選べる">
            <p>当オークションへの出品車はプロの査定員が査定、もしくは最終チェックした上で出品していますから品質に対する安心感が違います！</p>
        </div>
    </article>
</section>
<!-- end content_secon -->
<h2 class="text_center bgtit2"><img src="{{url('')}}/images/user/tit2.png" alt="スマオク！ご利用の流れ"></h2>
<p class="dis_sp lh00"><img src="{{url('')}}/images/user/bgline2_sp.jpg" alt=""></p>
<section class="section2">
    <article class="flexrowbetween">
        <div class="boxinfo">
            <img src="{{url('')}}/images/user/txtlable1.png" alt="お客さまor査定員が売りたいクルマ情報を登録">
            <p class="lh00"><img src="{{url('')}}/images/user/1.jpg" alt="お客さまor査定員が売りたいクルマ情報を登録" class="lh00"></p>
        </div>
        <div class="boxinfo">
            <img src="{{url('')}}/images/user/txtlable2.png" alt="スマオク！スタッフ確認OK後 オークション開始。">
            <p class="lh00"><img src="{{url('')}}/images/user/2.jpg" alt="スマオク！スタッフ確認OK後 オークション開始。" class="lh00"></p>
        </div>
        <div class="boxinfo">
            <img src="{{url('')}}/images/user/txtlable3.png" alt="オークション終了。一番高い業社を選べます。">
            <p class="lh00"><img src="{{url('')}}/images/user/3.jpg" alt="オークション終了。一番高い業社を選べます。" class="lh00"></p>
        </div>
    </article>
</section>
<!-- end content_secon -->
<h2 class="text_center bgtit3 dis_pc lh00"><img src="{{url('')}}/images/user/tit3.png" alt="スマオク！ご利用の流れ"></h2>
<h2 class="text_center bgtit3 dis_sp lh00"><img src="{{url('')}}/images/user/tit3_sp.png" alt="スマオク！ご利用の流れ"></h2>
<p class="dis_sp lh00"><img src="{{url('')}}/images/user/bgline3_sp.png" alt=""></p>
<section class="section3">
    <article class="flexrowbetween">
        <div class="boxcar">
            <div class="img">
                <img src="{{url('')}}/images/user/imdemo.png" alt="通常相場：120万円">
                <div class="price">
                    <p class="pricecar">164万円</p><span>で買取！</span>
                </div>
            </div>
            <p class="text_bold text_right txt_red fontshin">通常相場：120万円</p>
            <h4 class="fontshin">ホンダ インテグラ タイプS</h4>
            <p>年式：平成17年/型式tDC5/<br>走行距離：90,000km/<br>車検：平成30年3月17日</p>
        </div>
        <div class="boxcar">
            <div class="img">
                <img src="{{url('')}}/images/user/imdemo.png" alt="通常相場：120万円">
                <div class="price">
                    <p class="pricecar">164万円</p><span>で買取！</span>
                </div>
            </div>
            <p class="text_bold text_right txt_red fontshin">通常相場：120万円</p>
            <h4 class="fontshin">ホンダ インテグラ タイプS</h4>
            <p>年式：平成17年/型式tDC5/<br>走行距離：90,000km/<br>車検：平成30年3月17日</p>
        </div>
        <div class="boxcar">
            <div class="img">
                <img src="{{url('')}}/images/user/imdemo.png" alt="通常相場：120万円">
                <div class="price">
                    <p class="pricecar">164万円</p><span>で買取！</span>
                </div>
            </div>
            <p class="text_bold text_right txt_red fontshin">通常相場：120万円</p>
            <h4 class="fontshin">ホンダ インテグラ タイプS</h4>
            <p>年式：平成17年/型式tDC5/<br>走行距離：90,000km/<br>車検：平成30年3月17日</p>
        </div>
        <div class="boxcar">
            <div class="img">
                <img src="{{url('')}}/images/user/imdemo.png" alt="通常相場：120万円">
                <div class="price">
                    <p class="pricecar">164万円</p><span>で買取！</span>
                </div>
            </div>
            <p class="text_bold text_right txt_red fontshin">通常相場：120万円</p>
            <h4 class="fontshin">ホンダ インテグラ タイプS</h4>
            <p>年式：平成17年/型式tDC5/<br>走行距離：90,000km/<br>車検：平成30年3月17日</p>
        </div>
        <div class="boxcar">
            <div class="img">
                <img src="{{url('')}}/images/user/imdemo.png" alt="通常相場：120万円">
                <div class="price">
                    <p class="pricecar">164万円</p><span>で買取！</span>
                </div>
            </div>
            <p class="text_bold text_right txt_red fontshin">通常相場：120万円</p>
            <h4 class="fontshin">ホンダ インテグラ タイプS</h4>
            <p>年式：平成17年/型式tDC5/<br>走行距離：90,000km/<br>車検：平成30年3月17日</p>
        </div>
        <div class="boxcar">
            <div class="img">
                <img src="{{url('')}}/images/user/imdemo.png" alt="通常相場：120万円">
                <div class="price">
                    <p class="pricecar">164万円</p><span>で買取！</span>
                </div>
            </div>
            <p class="text_bold text_right txt_red fontshin">通常相場：120万円</p>
            <h4 class="fontshin">ホンダ インテグラ タイプS</h4>
            <p>年式：平成17年/型式tDC5/<br>走行距離：90,000km/<br>車検：平成30年3月17日</p>
        </div>
    </article>
</section>
<p class="text_center arrbg"><img src="{{url('')}}/images/user/arr_sp.png" alt="arrow"></p>
<!-- end content_secon -->
<article class="position">
    <form id="FormRegisterSeller2">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{ csrf_field() }}
        <div class="boxteltop">
            <h3 class="dis_pc text_center"><img src="{{url('')}}/images/user/titboxtel.png" alt="あなたの愛車、とりあえず価格だけチェック！"></h3>
            <h3 class="dis_sp text_center"><img src="{{url('')}}/images/user/titboxtel_sp.png" alt="あなたの愛車、とりあえず価格だけチェック！"></h3>
            <div class="tbbox">
                <table class="tbstyle">
                    <tr>
                        <th><span class="hinsu">必須</span> メーカー</th>
                        <td><select name="seller_maker" id="seller_maker2">
                                <option value=""></option>
                                @foreach($list_makers as $makers)
                                <option value="{{ $makers->id }}">{{ $makers->name }}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    <tr>
                        <th><span class="hinsu">必須</span> 車種</th>
                        <td><select name="seller_car_type" id="seller_car_type2">
                                <option value=""></option>
                                @foreach($list_cars as $cars)
                                <option value="{{ $cars->id }}">{{ $cars->name }}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    <tr>
                        <th><span class="ninni">任意</span> 年式</th>
                        <td><input type="text" value="" name="seller_date" id="seller_date2" size="" tabindex="" accesskey="" placeholder=""></td>
                    </tr>
                    <tr>
                        <th><span class="ninni">任意</span> 走行距離</th>
                        <td><input type="text" value="" name="seller_mileage" id="seller_mileage2" size="" tabindex="" accesskey="" placeholder=""></td>
                    </tr>
                </table>
                <table class="tbstyle">
                    <tr>
                        <th><span class="hinsu">必須</span> TEL</th>
                        <td><input type="text" value="" name="seller_tel" id="seller_tel2" size="" tabindex="" accesskey="" placeholder="例）09012345678" ></td>
                    </tr>
                    <tr>
                        <th><span class="hinsu">必須</span> 名前</th>
                        <td><input type="text" value="" name="seller_name" id="seller_name2" size="" tabindex="" accesskey="" placeholder="例）山田　太郎"></td>
                    </tr>
                    <tr>
                        <th><span class="ninni">任意</span> 都道府県</th>
                        <td><select name="seller_zone" id="seller_zone2">
                                <option value=""></option>
                                @foreach($list_zones as $zones)
                                <option value="{{ $zones->id }}">{{ $zones->name }}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    <tr>
                        <th><span class="ninni">任意</span> メール</th>
                        <td><input type="text" value="" name="seller_email" id="seller_email2" size="" tabindex="" accesskey="" placeholder="例）yamada@smart.com"></td>
                    </tr>
                </table>
            </div>
            <div class="boxbtn_tel">
                <div class="txt">
                    <p>お電話での価格査定をご希望の方</p>
                    <p class="dis_pc"><img src="{{url('images/user/txttelhd.png')}}" alt="tel:06-7670-7744"></p>
                    <p class="dis_sp"><a href="tel:06-7670-7744"><img src="{{url('images/user/txttelhd.png')}}." alt="tel:06-7670-7744"></a></p>
                </div>
                <div><p class="btn"><button type="submit" id="submit2" style="padding:0; border: none; cursor: pointer;"><img src="{{url('images/user/btn1.png')}}" alt="無料登録をする"></button></p></div>
            </div>
        </div>
    </form>
</article>
<!-- end content_secon -->
<h2 class="text_center bgtit4 dis_pc lh00"><img src="{{url('images/user/tit4.png')}}" alt="スマオク！プレオープン時お客様の声"></h2>
<h2 class="text_center bgtit4 dis_sp lh00"><img src="{{url('images/user/tit4_sp.png')}}" alt="スマオク！プレオープン時お客様の声"></h2>
<p class="dis_sp lh00"><img src="{{url('images/user/bgline4_sp.png')}}" alt=""></p>
<section class="section4">
    <article class="flexrowbetween">
        <div class="boxperson">
            <img src="{{url('')}}/images/user/per1.png" alt="">
            <h4 class="fontshin">大阪市　30代　女性 </h4>
            <p>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        </div>
        <div class="boxperson">
            <img src="{{url('')}}/images/user/per2.png" alt="">
            <h4 class="fontshin">大阪市　20代　女性 </h4>
            <p>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        </div>
        <div class="boxperson">
            <img src="{{url('')}}/images/user/per3.png" alt="">
            <h4 class="fontshin">大阪市　30代　女性 </h4>
            <p>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        </div>
        <div class="boxperson">
            <img src="{{url('')}}/images/user/per4.png" alt="">
            <h4 class="fontshin">大阪市　20代　女性 </h4>
            <p>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
        </div>
    </article>
</section>
<!-- end content_secon -->
<h2 class="text_center bgtit5 lh00"><img src="{{url('images/user/tit5.png')}}" alt="よくあるご質問"></h2>
<p class="dis_sp lh00"><img src="{{url('images/user/bgline5_sp.png')}}" alt=""></p>
<section class="section5">
    <article class="flexrowbetween">
        <dl class="boxfaq">
            <dt class="ac_title">質門が入ります？</dt>
            <dd class="ac_con">テキストが入ります。が入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</dd>
        </dl>
        <dl class="boxfaq">
            <dt class="ac_title">質門が入ります？</dt>
            <dd class="ac_con">テキストが入ります。が入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</dd>
        </dl>
        <dl class="boxfaq">
            <dt class="ac_title">質門が入ります？</dt>
            <dd class="ac_con">テキストが入ります。が入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</dd>
        </dl>
        <dl class="boxfaq">
            <dt class="ac_title">質門が入ります？</dt>
            <dd class="ac_con">テキストが入ります。が入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</dd>
        </dl>
        <dl class="boxfaq">
            <dt class="ac_title">質門が入ります？</dt>
            <dd class="ac_con">テキストが入ります。が入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</dd>
        </dl>
    </article>
</section>
<p class="text_center arrbg"><img src="{{url('')}}/images/user/arr2_sp.png" alt="arrow"></p>
<!-- end content_secon -->
<article class="position">
    <form id="FormRegisterSeller3" method="post">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{ csrf_field() }}
        <div class="boxteltop">
            <h3 class="dis_pc text_center"><img src="{{url('images/user/titboxtel.png')}}" alt="あなたの愛車、とりあえず価格だけチェック！"></h3>
            <h3 class="dis_sp text_center"><img src="{{url('images/user/titboxtel_sp.png')}}" alt="あなたの愛車、とりあえず価格だけチェック！"></h3>
            <div class="tbbox">
                <table class="tbstyle">
                    <tr>
                        <th><span class="hinsu">必須</span> メーカー</th>
                        <td><select name="seller_maker" id="seller_maker3">
                                <option value=""></option>
                                @foreach($list_makers as $makers)
                                <option value="{{ $makers->id }}">{{ $makers->name }}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    <tr>
                        <th><span class="hinsu">必須</span> 車種</th>
                        <td><select name="seller_car_type" id="seller_car_type3">
                                <option value=""></option>
                                @foreach($list_cars as $cars)
                                <option value="{{ $cars->id }}">{{ $cars->name }}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    <tr>
                        <th><span class="ninni">任意</span> 年式</th>
                        <td><input type="text" value="" name="seller_date" id="seller_date3" size="" tabindex="" accesskey="" placeholder=""></td>
                    </tr>
                    <tr>
                        <th><span class="ninni">任意</span> 走行距離</th>
                        <td><input type="text" value="" name="seller_mileage" id="seller_mileage3" size="" tabindex="" accesskey="" placeholder=""></td>
                    </tr>
                </table>
                <table class="tbstyle">
                    <tr>
                        <th><span class="hinsu">必須</span> TEL</th>
                        <td><input type="text" value="" name="seller_tel" id="seller_tel3" size="" tabindex="" accesskey="" placeholder="例）09012345678" ></td>
                    </tr>
                    <tr>
                        <th><span class="hinsu">必須</span> 名前</th>
                        <td><input type="text" value="" name="seller_name" id="seller_name3" size="" tabindex="" accesskey="" placeholder="例）山田　太郎"></td>
                    </tr>
                    <tr>
                        <th><span class="ninni">任意</span> 都道府県</th>
                        <td><select name="seller_zone" id="seller_zone3">
                                <option value=""></option>
                                @foreach($list_zones as $zones)
                                <option value="{{ $zones->id }}">{{ $zones->name }}</option>
                                @endforeach
                            </select></td>
                    </tr>
                    <tr>
                        <th><span class="ninni">任意</span> メール</th>
                        <td><input type="text" value="" name="seller_email" id="seller_email3" size="" tabindex="" accesskey="" placeholder="例）yamada@smart.com"></td>
                    </tr>
                </table>
            </div>
            <div class="boxbtn_tel">
                <div class="txt">
                    <p>お電話での価格査定をご希望の方</p>
                    <p class="dis_pc"><img src="{{url('images/user/txttelhd.png')}}" alt="tel:06-7670-7744"></p>
                    <p class="dis_sp"><a href="tel:06-7670-7744"><img src="{{url('images/user/txttelhd.png')}}" alt="tel:06-7670-7744"></a></p>
                </div>
                <div><p class="btn"><button type="submit" style="padding:0; border: none; cursor: pointer;" id="submit3"><img src="{{url('images/user/btn1.png')}}" alt="無料登録をする"></button></p></div>
            </div>
        </div>
    </form>
</article>
<script>
    $("#seller_maker").change(function()
    {
        var car = $(this).val();
        $(".car").css("display","none");
        $(".car-"+car).css("display","block");
        $("#seller_car_type").val('');
    })
</script>
<script src="{{url('js/user/user.js')}}" type="text/javascript"></script>
@endsection
@section('script')
<script src="{{url('js/common.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(window).load(function() {
        var viewportWidth = $(window).width();
        if (viewportWidth < 769) {
            $(".boxfaq dt").addClass("ac_title");
            $(".boxfaq dd").addClass("ac_con");
        } else {
            $(".boxfaq dt").removeClass("ac_title");
            $(".boxfaq dd").removeClass("ac_con");
        }
    });
</script>
@endsection