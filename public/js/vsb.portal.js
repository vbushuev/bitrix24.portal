//$(function(){
    var vsb={
        crm:{
            lead:{
                add:function(form,callback){
                    var params = {};
                	form.find("input,select").each(function(){
                		var t=$(this);
                		params[t.attr('name')]=t.val();
                	});
                	$.ajax({
                		url: '/bitrix24/leadadd?'+$.param(params)
                		,complete:function(x,t){}
                		,success:function(d,t,x){
                			console.debug("submited:["+d+"]");
                            callback(d);
                		}
                	});
                }
            }
        }
    };
//})();
