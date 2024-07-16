
function cek_form()
{
	$.each($('.operation'), function( index, value ) 
	{
		if($(value).parent().next().next().find('input').length > 0)
		{
			$(value).parent().next().next().find('input').attr('readonly',true);
		}
		else
		{
			$(value).parent().next().next().find('select').attr('readonly',true);			
		}
	});

}

$("body").off("click",".close.styling-close").on("click",".close.styling-close", function(e) 
{
	$(this).parents('.row.rowr').remove();
});

$("body").off("change",".operation").on("change",".operation", function(e) 
{
	// $(this).parent().next().find('input').val("");
	// $(this).parent().next().find('select').val("");
	$(this).parent().next().next().find('input').val("");
	$(this).parent().next().next().find('select').val("");
	$(this).parent().next().next().find('select').next().find("span").eq(0).find("span").eq(3).text("");
	
	$(this).parent().next().find('input').attr('readonly',false);
	$(this).parent().next().find('select').attr('readonly',false);
	if($(this).val() == 4)
	{		
		if($(this).parent().next().next().find('input').length > 0)
		{
			$(this).parent().next().next().find('input').attr('readonly',false);
		}
		else
		{
			$(this).parent().next().next().find('select').attr('readonly',false);
		}
	}
	else if($(this).val() == 8 || $(this).val() == 9)
	{		
		if($(this).parent().next().next().find('input').length > 0)
		{
			$(this).parent().next().find('input').attr('readonly',true);
			$(this).parent().next().next().find('input').attr('readonly',true);
		}
		else
		{
			$(this).parent().next().find('select').attr('readonly',true);
			$(this).parent().next().next().find('select').attr('readonly',true);
		}
	}
	else
	{
		if($(this).parent().next().next().find('input').length > 0)
		{
			$(this).parent().next().next().find('input').attr('readonly',true);
		}
		else
		{
			$(this).parent().next().next().find('select').attr('readonly',true);
		}
	}
});