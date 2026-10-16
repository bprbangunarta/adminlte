<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminLteTemplateTest extends TestCase
{
    public function test_dashboard_renders_with_adminlte_layout(): void
    {
        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('dist/css/AdminLTE.min.css', false)
            ->assertSee('main-sidebar', false);
    }

    public function test_blank_page_renders_with_breadcrumb(): void
    {
        $this->get(route('pages.blank'))
            ->assertOk()
            ->assertSee('Halaman Kosong');
    }

    public function test_login_page_renders(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('login-box', false);
    }

    public function test_layout_assets_exist_in_public_directory(): void
    {
        foreach ([
            'dist/css/AdminLTE.min.css',
            'dist/css/skins/skin-'.config('adminlte.skin').'.min.css',
            'dist/js/adminlte.min.js',
            'bower_components/jquery/dist/jquery.min.js',
            'bower_components/bootstrap/dist/js/bootstrap.min.js',
            'bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
            'bower_components/fastclick/lib/fastclick.js',
            'plugins/iCheck/icheck.min.js',
            'plugins/iCheck/square/blue.css',
        ] as $path) {
            $this->assertFileExists(public_path($path));
        }
    }
}
