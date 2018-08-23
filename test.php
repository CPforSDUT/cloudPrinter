<ul style="list-style-type:none;width: 180px">
    <li id="f">
        fds<a>
        </a>
    </li>
    <li id="q">
        ffff<a>
        </a>
    </li>
</ul>
<style>
    ul{
        -webkit-user-select:none;

        -moz-user-select:none;
        -o-user-select:none;
        user-select:none;
    }
</style>
<script>
    var f = document.getElementById("f");
    var q = document.getElementById("q");
    f.addEventListener("click",function () {
       f.style.backgroundColor = "#2f21d4";
        q.style.backgroundColor = "#FFFFFF";
    });
    q.addEventListener("click",function () {
        q.style.backgroundColor = "#2f21d4";
        f.style.backgroundColor = "#FFFFFF";
    });
</script>
