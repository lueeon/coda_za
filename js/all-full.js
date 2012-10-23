$(function() {
function m(v) {
		return document.getElementById(v)
	}
function h(y) {
		var x = m("comment");
		if (y) {
			if (document.selection) {
				sel = document.selection.createRange();
				sel.text = y
			} else {
				if (x.selectionStart || x.selectionStart == "0") {
					var w = x.selectionStart;
					var v = x.selectionEnd;
					var z = w;
					x.value = x.value.substring(0, w) + y + x.value.substring(v, x.value.length);
					z += y.length;
					x.selectionStart = z;
					x.selectionEnd = z
				} else {
					x.value += y
				}
			}
		}
	}
function e() {
		var x = $(".replyto");
		var w = $(".quote");
		var v = function(B) {
			var C = $(B).attr("href").replace(/.*#comment-/, "");
			//alert(C);
			var z = $("#comment-" + C + " .fn").text();
			//alert(z);
			var A = $("#comment-" + C + " .comment-content").html();
			//alert(A);
			return {
				id: C,
				name: z,
				content: A
			}
		};
		var y = function(z) {
			var B = $("#comment");
			var A = B.val();
			if (A.indexOf(z) > -1) {
				alert("You've already appended this!");
				return false
			}
			$.scrollTo(B, 600, {
				easing: "easeOutBounce",
				onAfter: function() {
					B.focus();
					if (A.replace(/\s|\t|\n/g, "") == "") {
						h(z)
					} else {
						h("\n\n" + z)
					}
				}
			})
		};
		x.click(function() {
			var A = v(this);
			var z = '<a href="#comment-' + A.id + '">@' + A.name + " </a>\n";
			y(z);
			return false
		});
		w.click(function() {
			var A = v(this);
			var z = '<blockquote cite="#commentbody-' + A.id + '">';
			z += '\n<strong><a href="#comment-' + A.id + '">' + A.name + "</a> :</strong>";
			z += A.content;
			z += "</blockquote>\n";
			z = z.replace(/\t/g, "");
			y(z);
			return false
		})
	}
	e();
function s() {
		var commentform=$("#commentform");
		var calldata=commentform.serialize();
		var ajaxbox=$("#ajaxbox");
		var submit=$("#submit");
		var callurl=themeurl+"/comment-ajax.php";
		var beforesend=function(){
			ajaxbox.slideDown(300);
			submit.attr("disabled",true);
		};
		var errorlog=function(G) {
			if (G.responseText) {
				alert(G.responseText)
			} else {
				alert("评论错误!")
			}
			ajaxbox.slideUp(200);
			submit.attr("disabled",false);
		};
		var succ=function(G){
				$("#comment").val("");
				$("#comments").append(G);
				ajaxbox.slideUp(600);
				var H = $("#comments li:last").hide();
				H.slideDown(600);
				submit.attr("disabled",false);
				//e();
		};
		$.ajax({
			url:callurl,
			data:calldata,
			type:"POST",
			dataType:"html",
			beforeSend:beforesend,
			error:errorlog,
			success:succ
		})
	}
	function q() {
		$("#commentform").submit(function() {
			s();
			return false
		});
		$("#commentform #comment").keydown(function(v) {
			if ((v.ctrlKey || v.altKey) && (v.keyCode == 13 || v.keyCode == 83)) {
				s();
				return false
			}
		})
	}
	q();
	function g() {
		$("#smiles").slideUp(0);
		$("#comment").focus(function(){
		$("#smiles").slideDown("normal");
		});
		var x = $("#smiles_list");
		var y = $("#smiles_list a");
		y.click(function() {
			var z = $(this).attr("title");
			$("#comment").focus();
			h(z);
			return false
		})
	}
	g();
    function ishare() {
        var thelink = encodeURIComponent(document.location),
            thetitle = encodeURIComponent(document.title.substring(0,60)),
            windowName = '分享到',
            param = getParamsOfShareWindow(600, 560),
            //各大SNS站点的分享机制，可自定义
            me_tqq = 'http://v.t.qq.com/share/share.php?title=' + thetitle + '&amp;url=' + thelink + '&amp;site=',
            me_qzone = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=' + thelink + '&amp;title=',
            me_tsina = 'http://v.t.sina.com.cn/share/share.php?url=' + thelink + '&amp;title=' + thetitle,
            me_douban = 'http://www.douban.com/recommend/?url=' + thelink + '&amp;title=' + thetitle,
            me_renren = 'http://share.renren.com/share/buttonshare?link=' + thelink + '&amp;title=' + thetitle,
            me_kaixin = 'http://www.kaixin001.com/repaste/share.php?rurl=' + thelink + '&amp;rcontent=' + thelink + '&amp;rtitle=' + thetitle,
            me_facebook = 'http://facebook.com/share.php?u=' + thelink + '&amp;t=' + thetitle,
            me_twitter = 'http://twitter.com/share?url=' + thelink + '&amp;text=' + thetitle;

        $('.ishare').each(function() {
            $(this).attr('title',windowName + $(this).text());
            $(this).click(function() {
                var httpUrl = eval($(this).attr('class').substring($(this).attr('class').lastIndexOf('me_')));
                window.open(httpUrl, windowName, param);
            });
        });
        function getParamsOfShareWindow(width, height) {
            return ['toolbar=0,status=0,resizable=1,width=' + width + ',height=' + height + ',left=',(screen.width-width)/2,',top=',(screen.height-height)/2].join('');
        }
    }
      ishare();	
      $(".share,.subscribe").click(function(){
		$(this).next().slideToggle("normal");
		return false
	});
      $(".comment_post").click(function(){
      var A=$("#respond");
      	if(A.length>0){
      		$.scrollTo(A, 600, {
      			easing: "easeOutBounce",
      			onAfter:function(){
      				$("#comment").focus();
      			}
      		});
      		return false;
      	}
      });
    	function atreply() {
		var y = null;
		var v = null;
		var z = {};
		var B = $("#comments");
		var D = $('#comments .comment-content a[href^="#comment-"]');
		D.each(function() {
			if ($(this).text().match(/^@/)) {
				$(this).addClass("atreply")
			}
		});
		var w = $("#comments .comment-content a.atreply");
		var x = function(J) {
			var F = blogURL + "?AjaxGetComment&id=" + J;
			var H = null;
			var G = function() {
				var K = '<li class="loadingtip tip">' + '<p class="ajaxloading">loading</p>' + "</li>";
				B.append(K);
				H = $(".tip");
				H.hide().css({
					top: z.top,
					left: z.left
				}).fadeTo(0, 0.95).fadeIn(300)
			};
			var E = function(K) {
				if (K.responseText) {
					alert(K.responseText)
				} else {
					alert(lang.commonError)
				}
			};
			var I = function(K) {
				var L = $(".tip").offset();
				$(".tip").replaceWith(K);
				$(".tip").css({
					top: L.top,
					left: L.left
				}).fadeTo(0, 0.9).find(".comment-meta,.reply").remove();
			};
			$.ajax({
				url: F,
				beforeSend: G,
				error: E,
				success: I
			})
		};
		var C = function(E) {
			$("#comment-" + E).clone().attr("id", "").appendTo(B).hide().addClass("tip").css({
				top: z.top,
				left: z.left
			}).fadeTo(0, 0.9).fadeIn(300).find(".comment-meta,.reply").remove();
		};
		var A = function() {
			$(".tip").fadeOut(300,
			function() {
				if ($(this).hasClass("ajax")) {
					$(this).removeClass("ajax tip")
				} else {
					$(this).remove()
				}
			})
		};
		w.hover(function() {
			var E = $(this).attr("href").replace(/.*#comment-/, "");
			 //alert(E);
			y = m("comment-" + E);
			if (!y) {
				v = setTimeout(function() {
					x(E)
				},
				200)
			} else {
				v = setTimeout(function() {
					C(E)
				},
				200)
			}
		},
		function() {
			clearTimeout(v);
			A()
		});
		w.click(function() {
			return false
		});
		$("#comments a.atreply").mousemove(function(E) {
			z.left = E.clientX;
			z.top = E.pageY + 18;
			$(".tip").css({
				left: z.left,
				top: z.top
			})
		})
	}
	atreply();    
});
