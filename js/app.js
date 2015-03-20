$(document).ready(function() {
	$(".list-group-item").click(function() {
		var ans = this.id.substring(7,8);
		$.post("../QA/getAns.php?qid="+qid, {ans: ans}).done(function(data){
			console.log(data);
		});
	})
});