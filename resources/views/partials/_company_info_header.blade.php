<div class="company-info">
    <div class="company-name">{{ $user -> company_name }}</div>
    <span class="info-update"><span class="info_head">企業名カナ：</span>{{ $user -> company_name_kana }}</span>
    <div class="create_mail">
        <span class="info-update"><span class="info_head">登録メールアドレス1：</span>{{ $user -> email }}</span>
        <span class="info-update"><span class="info_head">登録メールアドレス2：</span>{{ $user -> email2 }}</span>
        <span class="info-update"><span class="info_head">登録メールアドレス3：</span>{{ $user -> email3 }}</span>
    </div>
</div>