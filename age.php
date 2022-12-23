<script>

function reverse_birthday( $years ){
return date('Y-m-d', strtotime($years . ' years ago'));
}

$bd = reverse_birthday(18);
echo $bd; // 1993-04-16
</script>