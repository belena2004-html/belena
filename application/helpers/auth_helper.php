<?php

if (!function_exists('current_user')) {
    /**
     * Mengambil data lengkap user yang sedang login.
     * Menggunakan static variable agar query database hanya dijalankan sekali per request.
     * @return object|null
     */
    function current_user()
    {
        // Gunakan static variable untuk cache hasil query
        static $user = null;

        // Jika sudah ada data di cache, langsung kembalikan
        if ($user !== null) {
            return $user;
        }

        $CI = &get_instance();
        $id_user = $CI->session->userdata('id_user');

        if ($id_user) {
            // Ambil data user dari db dan simpan di cache
            $user = $CI->db->get_where('users', ['id_user' => $id_user])->row();
            return $user;
        }

        // Jika tidak ada user, kembalikan null
        return null;
    }
}
