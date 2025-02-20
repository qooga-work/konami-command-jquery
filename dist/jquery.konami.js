/*!
 * KONAMI COMMAND jQuery Plugin - A jQuery Framework for implementing Konami commands
 * Version: 1.0.0
 * Url: https://qooga.jb-jk.net/item/js/konami/ https://qooga.jb-jk.net/konami-command/
 * Author: Tam 0
 * Author url: https://qooga.jb-jk.net/
 * License: The MIT License (MIT)
 * License url: https://qooga.jb-jk.net/terms/
 * Date: 2019-08-29
 * Git: https://github.com/qooga-work/konami-command-jquery
 * Copyright (C) 2019 qooga.jb-jk.net - A project by Tam O
 */
(function ($) {
  jQuery.fn.konami = function(options) {
    // 厳格モード
    'use strict';

    // オプションで変動するモノ
    var defaults = {
      // 比較対象コマンドデータ
      // 38:上 40:下 37:左 39:右 66:B 65:A
      setCommand: [38,38,40,40,37,39,37,39,66,65],
      // 起動時
      onFunction: function(){alert("Start konami-command!");},
      // 停止時
      offFunction: function(){alert("End konami-command!");},
      // 保存するCookie名
      cookieName: 'konamiCMD',
    };
    var setting = jQuery.extend(defaults, options);

    // 入力されたキーを保存する
    var inputKey = [];

    // 文字数
    var keyLength = setting.setCommand.length;

    // cookie配列
    var readCookie = {
      'SameSite' : 'None',
    };

    // コマンド発動しているか　1:有効 0:無効
    var nowType = 0;

    // 画面上のキー入力イベントリスナ
    $(window).keyup(function(e) {

      // キー入力を配列に追加
      inputKey.push(e.keyCode);

      // 少なければ終了
      if(inputKey.length < keyLength){
        return false;
      }
      // 多ければ先入れを消す
      if(inputKey.length > keyLength){
        inputKey.splice(0, inputKey.length - keyLength);
      }

      // キー入力が保存された配列とコマンドを比較
      if (inputKey.toString().indexOf(setting.setCommand) >= 0) {
        // コマンド成功処理

        // cookieデータを1つずつに分ける
        var tc = document.cookie.split(';');
        tc.forEach(function(value) { 
          //cookie名と値に分ける
          var ts = value.split('=');
          readCookie[ts[0]] = ts[1];
        });
//      $.each(readCookie, function(t_key, t_value) {
//        console.log(t_key+'='+t_value);
//      })

        nowType = 0;
        if(!readCookie[setting.cookieName]){
          nowType = 1;
        }else if(readCookie[setting.cookieName] == 0){
          nowType = 1;
        }
        // クッキーに保存
        document.cookie = setting.cookieName+'='+nowType;

        if(nowType == 1){ // ON
          setting.onFunction();
        }else{ // OFF
          setting.offFunction();
        }

        //　キー入力を初期化
        inputKey = [];
      }
    });

  };
})(jQuery);