<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  <a
    class="dropdown-item"
    href="{{ url('user/auth/read', ['id' => session('user.id')]) }}"
    >个人主页</a
  >
  <a class="dropdown-item">
    <form
      action="{{ url('user/session/delete', ['id' => session('user.id')]) }}"
      method="POST"
    >
      @php echo token() @endphp

      <button class="btn btn-block" type="submit" name="button">退出</button>
    </form>
  </a>
</div>