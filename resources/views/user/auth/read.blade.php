<div class="panel-heading mb-3">
  <h4>欢迎您 {{ $user->name }}</h4>
  ++++
  <a
    class="btn btn-primary"
    href="{{ url('user/auth/edit', ['id' => session('user.id')]) }}"
    >编辑资料</a
  >
  ++++
</div>