PGDMP      2                 }            laravel    16.4    16.4     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    17933    laravel    DATABASE     �   CREATE DATABASE laravel WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE laravel;
                postgres    false            �            1255    18011    change_null(character varying)    FUNCTION     �   CREATE FUNCTION public.change_null(kosong character varying) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN COALESCE(kosong, '-');
END;
$$;
 <   DROP FUNCTION public.change_null(kosong character varying);
       public          postgres    false                       1255    18012 k   edit_member(integer, character varying, character varying, character varying, date, date, integer, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.edit_member(IN p_id_member integer, IN p_nama_member character varying DEFAULT NULL::character varying, IN p_email character varying DEFAULT NULL::character varying, IN p_nomor_telepon character varying DEFAULT NULL::character varying, IN p_tanggal_awal date DEFAULT NULL::date, IN p_tanggal_berakhir date DEFAULT NULL::date, IN p_id_admin integer DEFAULT NULL::integer, IN p_id_paket integer DEFAULT NULL::integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    -- Update data member dengan kondisi parameter opsional
    UPDATE member 
    SET 
        nama_member = COALESCE(p_nama_member, nama_member),
        email = COALESCE(p_email, email),
        nomor_telepon = COALESCE(p_nomor_telepon, nomor_telepon),
        tanggal_awal = COALESCE(p_tanggal_awal, tanggal_awal),
        tanggal_berakhir = COALESCE(p_tanggal_berakhir, tanggal_berakhir),
		id_admin = COALESCE(p_id_admin, id_admin),
        id_paket = COALESCE(p_id_paket, id_paket)
    WHERE id_member = p_id_member;

    -- Jika tidak ada baris yang diupdate, lempar exception
    IF NOT FOUND THEN
        RAISE EXCEPTION 'Member dengan ID % tidak ditemukan', p_id_member;
    END IF;
END;
$$;
   DROP PROCEDURE public.edit_member(IN p_id_member integer, IN p_nama_member character varying, IN p_email character varying, IN p_nomor_telepon character varying, IN p_tanggal_awal date, IN p_tanggal_berakhir date, IN p_id_admin integer, IN p_id_paket integer);
       public          postgres    false                       1255    18013 x   edit_paket_member(integer, character varying, character varying, character varying, numeric, character varying, integer) 	   PROCEDURE     ;  CREATE PROCEDURE public.edit_paket_member(IN pm_id_paket integer, IN pm_nama_paket character varying, IN pm_keterangan_fasilitas character varying, IN pm_keterangan_durasi character varying, IN pm_harga numeric, IN pm_keterangan_private character varying, IN pm_id_admin integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    -- Update data member dengan kondisi parameter opsional
     UPDATE paket_member SET nama_paket = pm_nama_paket, 
	 keterangan_fasilitas = pm_keterangan_fasilitas, 
	 keterangan_durasi = pm_keterangan_durasi, harga = pm_harga, 
	 keterangan_private = pm_keterangan_private, id_admin = pm_id_admin WHERE id_paket = pm_id_paket;

    -- Jika tidak ada baris yang diupdate, lempar exception
    IF NOT FOUND THEN
        RAISE EXCEPTION 'Member dengan ID % tidak ditemukan', p_id_member;
    END IF;
END;
$$;
   DROP PROCEDURE public.edit_paket_member(IN pm_id_paket integer, IN pm_nama_paket character varying, IN pm_keterangan_fasilitas character varying, IN pm_keterangan_durasi character varying, IN pm_harga numeric, IN pm_keterangan_private character varying, IN pm_id_admin integer);
       public          postgres    false                       1255    18014    format_tanggal(date)    FUNCTION     �   CREATE FUNCTION public.format_tanggal(tanggal date) RETURNS character varying
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN TO_CHAR(tanggal, 'DD Month YYYY');
END;
$$;
 3   DROP FUNCTION public.format_tanggal(tanggal date);
       public          postgres    false                       1255    18015    hitung_biaya_daftar(numeric)    FUNCTION     �   CREATE FUNCTION public.hitung_biaya_daftar(harga numeric) RETURNS numeric
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN 50000 + harga;
END;
$$;
 9   DROP FUNCTION public.hitung_biaya_daftar(harga numeric);
       public          postgres    false            	           1255    18016    hitung_selisih_hari(date, date)    FUNCTION     �  CREATE FUNCTION public.hitung_selisih_hari(tanggal_awal date, tanggal_akhir date) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE
    masa_berlaku_akhir DATE;
BEGIN
    -- Tambahkan 1 hari ke tanggal akhir untuk membuat masa berlaku hingga akhir hari tersebut
    masa_berlaku_akhir := tanggal_akhir + INTERVAL '1 day';
    
    -- Kembalikan selisih hari dengan memastilkan nilai minimal 0
    RETURN GREATEST(0, masa_berlaku_akhir - tanggal_awal);
END;
$$;
 Q   DROP FUNCTION public.hitung_selisih_hari(tanggal_awal date, tanggal_akhir date);
       public          postgres    false            
           1255    18017 Z   register_admin(character varying, character varying, character varying, character varying) 	   PROCEDURE     �  CREATE PROCEDURE public.register_admin(IN ad_username character varying, IN ad_email character varying, IN ad_password character varying, IN ad_veridy_token character varying)
    LANGUAGE plpgsql
    AS $$
BEGIN
    -- Masukkan data admin
	INSERT INTO admin (username, email, password,token_verify,status_verify) 
	VALUES (ad_username, ad_email, ad_password, ad_veridy_token, 0);
END;
$$;
 �   DROP PROCEDURE public.register_admin(IN ad_username character varying, IN ad_email character varying, IN ad_password character varying, IN ad_veridy_token character varying);
       public          postgres    false                       1255    18018    selisih_tanggal(date, date)    FUNCTION     �   CREATE FUNCTION public.selisih_tanggal(tanggal_awal date, tanggal_akhir date) RETURNS integer
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN tanggal_akhir - tanggal_awal;
END;
$$;
 M   DROP FUNCTION public.selisih_tanggal(tanggal_awal date, tanggal_akhir date);
       public          postgres    false                       1255    18019 w   tambah_member(character varying, character varying, character varying, character varying, date, date, integer, integer) 	   PROCEDURE     �  CREATE PROCEDURE public.tambah_member(IN p_nama_member character varying, IN p_email character varying, IN p_password_hash character varying, IN p_nomor_telepon character varying, IN p_tanggal_awal date, IN p_tanggal_berakhir date, IN p_id_paket integer, IN p_id_admin integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    -- Masukkan data member
    INSERT INTO member (
        nama_member, 
        email, 
        password, 
        nomor_telepon, 
        tanggal_awal, 
        tanggal_berakhir, 
        id_paket, 
        id_admin
    ) VALUES (
        p_nama_member,
        p_email,
        p_password_hash,
        p_nomor_telepon,
        p_tanggal_awal,
        p_tanggal_berakhir,
        p_id_paket,
        p_id_admin
    );
END;
$$;
   DROP PROCEDURE public.tambah_member(IN p_nama_member character varying, IN p_email character varying, IN p_password_hash character varying, IN p_nomor_telepon character varying, IN p_tanggal_awal date, IN p_tanggal_berakhir date, IN p_id_paket integer, IN p_id_admin integer);
       public          postgres    false            �            1255    18020 �   tambah_member_transaksi(character varying, character varying, character varying, character varying, integer, character varying, numeric) 	   PROCEDURE     �  CREATE PROCEDURE public.tambah_member_transaksi(IN v_nama character varying, IN v_email character varying, IN v_password character varying, IN v_nomor_telepon character varying, IN v_durasi integer, IN v_invoice character varying, IN v_harga_paket numeric)
    LANGUAGE plpgsql
    AS $$
DECLARE
    v_id_member INT;
BEGIN
    -- Tambah member baru
    INSERT INTO member(nama_member, email, password, nomor_telepon, tanggal_awal, tanggal_berakhir, id_paket, id_admin)
    VALUES (v_nama, v_email, v_password, v_nomor_telepon, CURRENT_DATE, CURRENT_DATE + INTERVAL '1 month' * v_durasi, v_durasi, null)
    RETURNING id_member INTO v_id_member;

    -- Tambah transaksi baru
    INSERT INTO transaksi(id_paket, invoice, total_harga, tanggal_transaksi, id_member, status_pembayaran)
    VALUES (v_durasi, v_invoice, hitung_biaya_daftar(v_harga_paket), CURRENT_DATE, v_id_member, 'successful');
END;
$$;
    DROP PROCEDURE public.tambah_member_transaksi(IN v_nama character varying, IN v_email character varying, IN v_password character varying, IN v_nomor_telepon character varying, IN v_durasi integer, IN v_invoice character varying, IN v_harga_paket numeric);
       public          postgres    false            �            1255    18021 j   tambah_paket(character varying, character varying, character varying, numeric, character varying, integer) 	   PROCEDURE     6  CREATE PROCEDURE public.tambah_paket(IN pm_nam_paket character varying, IN pm_keterangan_fasilitas character varying, IN pm_keterangan_durasi character varying, IN pm_harga numeric, IN pm_keterangan_private character varying, IN pm_id_admin integer)
    LANGUAGE plpgsql
    AS $$
BEGIN
    -- Masukkan data paket member
	INSERT INTO paket_member (nama_paket, keterangan_fasilitas, keterangan_durasi, harga, keterangan_private, id_admin)  
	VALUES (pm_nam_paket, pm_keterangan_fasilitas, pm_keterangan_durasi, pm_harga, pm_keterangan_private, pm_id_admin);
END;
$$;
 �   DROP PROCEDURE public.tambah_paket(IN pm_nam_paket character varying, IN pm_keterangan_fasilitas character varying, IN pm_keterangan_durasi character varying, IN pm_harga numeric, IN pm_keterangan_private character varying, IN pm_id_admin integer);
       public          postgres    false            �            1259    18022    absen_harian    TABLE     �   CREATE TABLE public.absen_harian (
    id_pertemuan integer NOT NULL,
    id_member integer,
    tanggal_datang timestamp without time zone NOT NULL,
    keterangan text
);
     DROP TABLE public.absen_harian;
       public         heap    postgres    false            �            1259    18027    absen_harian_id_pertemuan_seq    SEQUENCE     �   CREATE SEQUENCE public.absen_harian_id_pertemuan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.absen_harian_id_pertemuan_seq;
       public          postgres    false    228            �           0    0    absen_harian_id_pertemuan_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.absen_harian_id_pertemuan_seq OWNED BY public.absen_harian.id_pertemuan;
          public          postgres    false    229            �            1259    18028    admin    TABLE     �  CREATE TABLE public.admin (
    id_admin integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(100) NOT NULL,
    reset_token_hash character varying(64) DEFAULT NULL::character varying,
    reset_token_expires_at timestamp without time zone,
    token_verify character varying(150),
    status_verify integer
);
    DROP TABLE public.admin;
       public         heap    postgres    false            �            1259    18034    admin_id_admin_seq    SEQUENCE     �   CREATE SEQUENCE public.admin_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.admin_id_admin_seq;
       public          postgres    false    230            �           0    0    admin_id_admin_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.admin_id_admin_seq OWNED BY public.admin.id_admin;
          public          postgres    false    231            �            1259    17968    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap    postgres    false            �            1259    17975    cache_locks    TABLE     �   CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache_locks;
       public         heap    postgres    false            �            1259    18000    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    17999    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          postgres    false    227            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          postgres    false    226            �            1259    17992    job_batches    TABLE     d  CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);
    DROP TABLE public.job_batches;
       public         heap    postgres    false            �            1259    17983    jobs    TABLE     �   CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
    DROP TABLE public.jobs;
       public         heap    postgres    false            �            1259    17982    jobs_id_seq    SEQUENCE     t   CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.jobs_id_seq;
       public          postgres    false    224            �           0    0    jobs_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;
          public          postgres    false    223            �            1259    18035    laporan    TABLE     n   CREATE TABLE public.laporan (
    id_laporan integer NOT NULL,
    id_member integer,
    isi_keluhan text
);
    DROP TABLE public.laporan;
       public         heap    postgres    false            �            1259    18040    laporan_id_laporan_seq    SEQUENCE     �   CREATE SEQUENCE public.laporan_id_laporan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.laporan_id_laporan_seq;
       public          postgres    false    232            �           0    0    laporan_id_laporan_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.laporan_id_laporan_seq OWNED BY public.laporan.id_laporan;
          public          postgres    false    233            �            1259    18041    member    TABLE     t  CREATE TABLE public.member (
    id_member integer NOT NULL,
    nama_member character varying(150) NOT NULL,
    email character varying(150) NOT NULL,
    password character varying(255) NOT NULL,
    nomor_telepon character varying(15) NOT NULL,
    tanggal_awal date NOT NULL,
    tanggal_berakhir date NOT NULL,
    id_paket integer NOT NULL,
    id_admin integer
);
    DROP TABLE public.member;
       public         heap    postgres    false            �            1259    18046    member_id_admin_seq    SEQUENCE     �   CREATE SEQUENCE public.member_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.member_id_admin_seq;
       public          postgres    false    234            �           0    0    member_id_admin_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.member_id_admin_seq OWNED BY public.member.id_admin;
          public          postgres    false    235            �            1259    18047    member_id_member_seq    SEQUENCE     �   CREATE SEQUENCE public.member_id_member_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.member_id_member_seq;
       public          postgres    false    234            �           0    0    member_id_member_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.member_id_member_seq OWNED BY public.member.id_member;
          public          postgres    false    236            �            1259    17935 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    17934    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    216            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    215            �            1259    18048    paket_member    TABLE     B  CREATE TABLE public.paket_member (
    id_paket integer NOT NULL,
    nama_paket character varying(150) NOT NULL,
    keterangan_fasilitas character varying(150),
    keterangan_durasi character varying(50),
    harga numeric(10,2) NOT NULL,
    keterangan_private character varying(150),
    id_admin integer NOT NULL
);
     DROP TABLE public.paket_member;
       public         heap    postgres    false            �            1259    18053    paket_member_id_admin_seq    SEQUENCE     �   CREATE SEQUENCE public.paket_member_id_admin_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.paket_member_id_admin_seq;
       public          postgres    false    237            �           0    0    paket_member_id_admin_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.paket_member_id_admin_seq OWNED BY public.paket_member.id_admin;
          public          postgres    false    238            �            1259    18054    paket_member_id_paket_seq    SEQUENCE     �   CREATE SEQUENCE public.paket_member_id_paket_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.paket_member_id_paket_seq;
       public          postgres    false    237            �           0    0    paket_member_id_paket_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.paket_member_id_paket_seq OWNED BY public.paket_member.id_paket;
          public          postgres    false    239            �            1259    17952    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    17959    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    postgres    false            �            1259    18055 	   transaksi    TABLE     7  CREATE TABLE public.transaksi (
    id_transaksi integer NOT NULL,
    id_member integer,
    id_paket integer,
    invoice character varying(50),
    total_harga numeric(10,2) NOT NULL,
    tanggal_transaksi timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    status_pembayaran character varying(20)
);
    DROP TABLE public.transaksi;
       public         heap    postgres    false            �            1259    18059    transaksi_id_transaksi_seq    SEQUENCE     �   CREATE SEQUENCE public.transaksi_id_transaksi_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.transaksi_id_transaksi_seq;
       public          postgres    false    240            �           0    0    transaksi_id_transaksi_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.transaksi_id_transaksi_seq OWNED BY public.transaksi.id_transaksi;
          public          postgres    false    241            �            1259    17942    users    TABLE     x  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    17941    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    218            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    217            �            1259    18060    view_check_double_customer    VIEW     i   CREATE VIEW public.view_check_double_customer AS
 SELECT email,
    nomor_telepon
   FROM public.member;
 -   DROP VIEW public.view_check_double_customer;
       public          postgres    false    234    234            �            1259    18064    view_detail_member    VIEW     �  CREATE VIEW public.view_detail_member AS
 SELECT m.id_member,
    m.nama_member,
    m.email,
    m.password,
    m.nomor_telepon,
    public.format_tanggal(m.tanggal_awal) AS tanggal_awal,
    public.format_tanggal(m.tanggal_berakhir) AS tanggal_berakhir,
    p.nama_paket,
    p.keterangan_fasilitas,
    p.keterangan_durasi,
    public.change_null(p.keterangan_private) AS keterangan_private
   FROM (public.member m
     LEFT JOIN public.paket_member p ON ((m.id_paket = p.id_paket)));
 %   DROP VIEW public.view_detail_member;
       public          postgres    false    237    237    237    237    237    234    234    234    234    234    234    234    234    263    247            �            1259    18069    view_member_absen_list    VIEW       CREATE VIEW public.view_member_absen_list AS
 SELECT a.id_pertemuan,
    public.format_tanggal((a.tanggal_datang)::date) AS tanggal_datang,
    m.nama_member,
    p.keterangan_fasilitas,
    public.format_tanggal(m.tanggal_berakhir) AS tanggal_berakhir,
    p.keterangan_durasi,
    public.change_null((a.keterangan)::character varying) AS keterangan_absen
   FROM ((public.absen_harian a
     LEFT JOIN public.member m ON ((a.id_member = m.id_member)))
     LEFT JOIN public.paket_member p ON ((m.id_paket = p.id_paket)));
 )   DROP VIEW public.view_member_absen_list;
       public          postgres    false    263    237    237    237    234    234    234    234    228    228    228    228    247            �            1259    18074    view_member_list    VIEW     �  CREATE VIEW public.view_member_list AS
 SELECT m.id_member,
    m.nama_member,
    m.nomor_telepon,
    p.keterangan_durasi,
    p.keterangan_fasilitas,
    public.format_tanggal(m.tanggal_berakhir) AS format_tanggal_berakhir,
    m.tanggal_berakhir,
    public.hitung_selisih_hari(CURRENT_DATE, m.tanggal_berakhir) AS selisih,
    public.change_null(p.keterangan_private) AS keterangan
   FROM (public.member m
     LEFT JOIN public.paket_member p ON ((p.id_paket = m.id_paket)));
 #   DROP VIEW public.view_member_list;
       public          postgres    false    234    247    263    265    234    237    237    237    237    234    234    234            �            1259    18079    view_member_transaction_list    VIEW     �  CREATE VIEW public.view_member_transaction_list AS
 SELECT DISTINCT public.format_tanggal((t.tanggal_transaksi)::date) AS tanggal_transaksi_formated,
    t.invoice,
    t.id_transaksi,
    t.tanggal_transaksi,
    m.nama_member,
    m.nomor_telepon,
    p.keterangan_fasilitas,
    p.keterangan_durasi,
    t.status_pembayaran,
    t.total_harga
   FROM ((public.member m
     JOIN public.transaksi t ON ((m.id_member = t.id_member)))
     JOIN public.paket_member p ON ((t.id_paket = p.id_paket)));
 /   DROP VIEW public.view_member_transaction_list;
       public          postgres    false    240    240    240    240    240    240    240    237    237    237    234    234    234    263            �           2604    18084    absen_harian id_pertemuan    DEFAULT     �   ALTER TABLE ONLY public.absen_harian ALTER COLUMN id_pertemuan SET DEFAULT nextval('public.absen_harian_id_pertemuan_seq'::regclass);
 H   ALTER TABLE public.absen_harian ALTER COLUMN id_pertemuan DROP DEFAULT;
       public          postgres    false    229    228            �           2604    18085    admin id_admin    DEFAULT     p   ALTER TABLE ONLY public.admin ALTER COLUMN id_admin SET DEFAULT nextval('public.admin_id_admin_seq'::regclass);
 =   ALTER TABLE public.admin ALTER COLUMN id_admin DROP DEFAULT;
       public          postgres    false    231    230            �           2604    18003    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    227    227            �           2604    17986    jobs id    DEFAULT     b   ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);
 6   ALTER TABLE public.jobs ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    224    224            �           2604    18086    laporan id_laporan    DEFAULT     x   ALTER TABLE ONLY public.laporan ALTER COLUMN id_laporan SET DEFAULT nextval('public.laporan_id_laporan_seq'::regclass);
 A   ALTER TABLE public.laporan ALTER COLUMN id_laporan DROP DEFAULT;
       public          postgres    false    233    232            �           2604    18087    member id_member    DEFAULT     t   ALTER TABLE ONLY public.member ALTER COLUMN id_member SET DEFAULT nextval('public.member_id_member_seq'::regclass);
 ?   ALTER TABLE public.member ALTER COLUMN id_member DROP DEFAULT;
       public          postgres    false    236    234            �           2604    18088    member id_admin    DEFAULT     r   ALTER TABLE ONLY public.member ALTER COLUMN id_admin SET DEFAULT nextval('public.member_id_admin_seq'::regclass);
 >   ALTER TABLE public.member ALTER COLUMN id_admin DROP DEFAULT;
       public          postgres    false    235    234            �           2604    17938    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            �           2604    18089    paket_member id_paket    DEFAULT     ~   ALTER TABLE ONLY public.paket_member ALTER COLUMN id_paket SET DEFAULT nextval('public.paket_member_id_paket_seq'::regclass);
 D   ALTER TABLE public.paket_member ALTER COLUMN id_paket DROP DEFAULT;
       public          postgres    false    239    237            �           2604    18090    paket_member id_admin    DEFAULT     ~   ALTER TABLE ONLY public.paket_member ALTER COLUMN id_admin SET DEFAULT nextval('public.paket_member_id_admin_seq'::regclass);
 D   ALTER TABLE public.paket_member ALTER COLUMN id_admin DROP DEFAULT;
       public          postgres    false    238    237            �           2604    18091    transaksi id_transaksi    DEFAULT     �   ALTER TABLE ONLY public.transaksi ALTER COLUMN id_transaksi SET DEFAULT nextval('public.transaksi_id_transaksi_seq'::regclass);
 E   ALTER TABLE public.transaksi ALTER COLUMN id_transaksi DROP DEFAULT;
       public          postgres    false    241    240            �           2604    17945    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218            �          0    18022    absen_harian 
   TABLE DATA           [   COPY public.absen_harian (id_pertemuan, id_member, tanggal_datang, keterangan) FROM stdin;
    public          postgres    false    228   2�       �          0    18028    admin 
   TABLE DATA           �   COPY public.admin (id_admin, username, password, email, reset_token_hash, reset_token_expires_at, token_verify, status_verify) FROM stdin;
    public          postgres    false    230   ��       �          0    17968    cache 
   TABLE DATA           7   COPY public.cache (key, value, expiration) FROM stdin;
    public          postgres    false    221   �       �          0    17975    cache_locks 
   TABLE DATA           =   COPY public.cache_locks (key, owner, expiration) FROM stdin;
    public          postgres    false    222   7�       �          0    18000    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    227   T�       �          0    17992    job_batches 
   TABLE DATA           �   COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
    public          postgres    false    225   q�       �          0    17983    jobs 
   TABLE DATA           c   COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
    public          postgres    false    224   ��       �          0    18035    laporan 
   TABLE DATA           E   COPY public.laporan (id_laporan, id_member, isi_keluhan) FROM stdin;
    public          postgres    false    232   ��       �          0    18041    member 
   TABLE DATA           �   COPY public.member (id_member, nama_member, email, password, nomor_telepon, tanggal_awal, tanggal_berakhir, id_paket, id_admin) FROM stdin;
    public          postgres    false    234   ȹ       �          0    17935 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    216   ��       �          0    18048    paket_member 
   TABLE DATA           �   COPY public.paket_member (id_paket, nama_paket, keterangan_fasilitas, keterangan_durasi, harga, keterangan_private, id_admin) FROM stdin;
    public          postgres    false    237   B�       �          0    17952    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    219   ��       �          0    17959    sessions 
   TABLE DATA           _   COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
    public          postgres    false    220   Ծ       �          0    18055 	   transaksi 
   TABLE DATA           �   COPY public.transaksi (id_transaksi, id_member, id_paket, invoice, total_harga, tanggal_transaksi, status_pembayaran) FROM stdin;
    public          postgres    false    240   ��       �          0    17942    users 
   TABLE DATA           u   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
    public          postgres    false    218   �       �           0    0    absen_harian_id_pertemuan_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.absen_harian_id_pertemuan_seq', 18, true);
          public          postgres    false    229            �           0    0    admin_id_admin_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.admin_id_admin_seq', 23, true);
          public          postgres    false    231            �           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
          public          postgres    false    226            �           0    0    jobs_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);
          public          postgres    false    223            �           0    0    laporan_id_laporan_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.laporan_id_laporan_seq', 1, false);
          public          postgres    false    233            �           0    0    member_id_admin_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.member_id_admin_seq', 26, true);
          public          postgres    false    235            �           0    0    member_id_member_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.member_id_member_seq', 111, true);
          public          postgres    false    236            �           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 3, true);
          public          postgres    false    215            �           0    0    paket_member_id_admin_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.paket_member_id_admin_seq', 4, true);
          public          postgres    false    238            �           0    0    paket_member_id_paket_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.paket_member_id_paket_seq', 18, true);
          public          postgres    false    239            �           0    0    transaksi_id_transaksi_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.transaksi_id_transaksi_seq', 135, true);
          public          postgres    false    241            �           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 1, false);
          public          postgres    false    217            �           2606    18093    absen_harian absen_harian_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.absen_harian
    ADD CONSTRAINT absen_harian_pkey PRIMARY KEY (id_pertemuan);
 H   ALTER TABLE ONLY public.absen_harian DROP CONSTRAINT absen_harian_pkey;
       public            postgres    false    228            �           2606    18095    admin admin_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (id_admin);
 :   ALTER TABLE ONLY public.admin DROP CONSTRAINT admin_pkey;
       public            postgres    false    230            �           2606    18097     admin admin_reset_token_hash_key 
   CONSTRAINT     g   ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_reset_token_hash_key UNIQUE (reset_token_hash);
 J   ALTER TABLE ONLY public.admin DROP CONSTRAINT admin_reset_token_hash_key;
       public            postgres    false    230            �           2606    17981    cache_locks cache_locks_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
 F   ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
       public            postgres    false    222            �           2606    17974    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public            postgres    false    221            �           2606    18008    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            postgres    false    227            �           2606    18010 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            postgres    false    227            �           2606    17998    job_batches job_batches_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
       public            postgres    false    225            �           2606    17990    jobs jobs_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.jobs DROP CONSTRAINT jobs_pkey;
       public            postgres    false    224            �           2606    18099    laporan laporan_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.laporan
    ADD CONSTRAINT laporan_pkey PRIMARY KEY (id_laporan);
 >   ALTER TABLE ONLY public.laporan DROP CONSTRAINT laporan_pkey;
       public            postgres    false    232            �           2606    18101    member member_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.member
    ADD CONSTRAINT member_pkey PRIMARY KEY (id_member);
 <   ALTER TABLE ONLY public.member DROP CONSTRAINT member_pkey;
       public            postgres    false    234            �           2606    17940    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    216            �           2606    18103    paket_member paket_member_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.paket_member
    ADD CONSTRAINT paket_member_pkey PRIMARY KEY (id_paket);
 H   ALTER TABLE ONLY public.paket_member DROP CONSTRAINT paket_member_pkey;
       public            postgres    false    237            �           2606    17958 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    219            �           2606    17965    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            postgres    false    220            �           2606    18105    transaksi transaksi_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.transaksi
    ADD CONSTRAINT transaksi_pkey PRIMARY KEY (id_transaksi);
 B   ALTER TABLE ONLY public.transaksi DROP CONSTRAINT transaksi_pkey;
       public            postgres    false    240            �           2606    17951    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    218            �           2606    17949    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    218            �           1259    18106    idx_nama    INDEX     B   CREATE INDEX idx_nama ON public.member USING btree (nama_member);
    DROP INDEX public.idx_nama;
       public            postgres    false    234            �           1259    17991    jobs_queue_index    INDEX     B   CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
 $   DROP INDEX public.jobs_queue_index;
       public            postgres    false    224            �           1259    17967    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            postgres    false    220            �           1259    17966    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            postgres    false    220            �           2606    18107 (   absen_harian absen_harian_id_member_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.absen_harian
    ADD CONSTRAINT absen_harian_id_member_fkey FOREIGN KEY (id_member) REFERENCES public.member(id_member);
 R   ALTER TABLE ONLY public.absen_harian DROP CONSTRAINT absen_harian_id_member_fkey;
       public          postgres    false    228    4836    234            �           2606    18112    member fk_admin_member    FK CONSTRAINT     |   ALTER TABLE ONLY public.member
    ADD CONSTRAINT fk_admin_member FOREIGN KEY (id_admin) REFERENCES public.admin(id_admin);
 @   ALTER TABLE ONLY public.member DROP CONSTRAINT fk_admin_member;
       public          postgres    false    230    234    4829            �           2606    18117    paket_member fk_admin_paket    FK CONSTRAINT     �   ALTER TABLE ONLY public.paket_member
    ADD CONSTRAINT fk_admin_paket FOREIGN KEY (id_admin) REFERENCES public.admin(id_admin);
 E   ALTER TABLE ONLY public.paket_member DROP CONSTRAINT fk_admin_paket;
       public          postgres    false    230    4829    237            �           2606    18122    laporan laporan_id_member_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.laporan
    ADD CONSTRAINT laporan_id_member_fkey FOREIGN KEY (id_member) REFERENCES public.member(id_member);
 H   ALTER TABLE ONLY public.laporan DROP CONSTRAINT laporan_id_member_fkey;
       public          postgres    false    4836    234    232            �           2606    18127    member member_id_paket_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.member
    ADD CONSTRAINT member_id_paket_fkey FOREIGN KEY (id_paket) REFERENCES public.paket_member(id_paket);
 E   ALTER TABLE ONLY public.member DROP CONSTRAINT member_id_paket_fkey;
       public          postgres    false    4838    237    234            �           2606    18132 "   transaksi transaksi_id_member_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.transaksi
    ADD CONSTRAINT transaksi_id_member_fkey FOREIGN KEY (id_member) REFERENCES public.member(id_member);
 L   ALTER TABLE ONLY public.transaksi DROP CONSTRAINT transaksi_id_member_fkey;
       public          postgres    false    240    4836    234            �           2606    18137 !   transaksi transaksi_id_paket_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.transaksi
    ADD CONSTRAINT transaksi_id_paket_fkey FOREIGN KEY (id_paket) REFERENCES public.paket_member(id_paket);
 K   ALTER TABLE ONLY public.transaksi DROP CONSTRAINT transaksi_id_paket_fkey;
       public          postgres    false    240    4838    237            �   {   x�}�1�@�z��| ���v.y�iR���hR-��Y[��Tɑu(e��n����n����|�֫<�%\�M*�W6#&e,�"��&��S������!��}�#e?���> DQ�      �   M  x�m��r�0 E���-I $�VD|UG|���A	����qtcg���s�Q�⒰�h�[X-�`�_7b�˒�8F����~�,G�v�JF���i��[��i�C�O��A�$m�\��k&5�O��
`n�	`[�^>tcd2񵝇E*g5�uz$hn_ᨰ��O^���Xva�Ma)�E��4ڻ�ȱ�@ h L��u����ׁ���~M�$r�C;��;�cXmhy����ˠ��Q��o��{ ��L��g.�������,V9�=�,D�e]�V�Y�rv�Ǎh�ӱX�if#�zOH��՛ !0w\�;ҥ��$�!��{Ʈm��/����      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �      x������ � �      �     x�}�Kw�8��ů�"��X��Z�&��t��ld��l�1� �~J�	�1��W�ϥҽe3z\
�Ȗ)|��Z�bËy.�D0�ŧ*���P�y~F�C�5!�$<HZI �C3�aݖ�S�ڎ�vk��	�g`�ک�.D�]��<CtΓ$���W�L8�Xu��h�:�؂@e��
j��	�/@	��#p_r9�zW���]�����Z)tJ�e*Kx�{]m�Ztd�Ë=Ɗ]x�R�Ժ�r	i��5qj��1���f`��\Z�O!��~GAH=�P���l��p2�޲|-J4q2��&�6&���s�v�|��K!���N�Lo��qC�LL/;�^>qF �BYwj>ǲs���%a�`f����SƭI&(2n�P��l3�y8N\A?�����A��3Tį��&����ϟ��G���P�9*R:b�ι�:�	��/�ʭ~��D��Un�J���3y�y�LO�^V�ѭ5�$�SI{�IR;b��9ϝ�߅�lɭ����K��BKZ�:j�ι�:�?���)���4l��f�ۙ�=�S�� RUˏ��gy���d���!�Ѩ0�=�R�렇&-�FE��W���4��d�߀��1�y�}zB�-�a�����aT�(�Ti��wi����h:�H���|Zf�bb��;�A�'�9��}:E�{�sms�_��.q�ѫ3qO`�#�p�K1.�n��s5o�p��8ȟ����b%�y������X�NJ�Hi��y��4�l-�7��;�����:�Gc�my���E����i�{�(�0�u+���1^�����/�O�h���k^�gّȪ�*;U�j�X����p7}�I�6�>SJ�¾N�N@���mk�h�<���V���5ۏ����K��y��En�MN���~���[���,���1^V�F۟p�b�U�1���������#I��1x*���T�S%.|U���}Y��F�!^�|�m����n4�_m���������}�缉ɲ:+�?1�g1����+O���3�DZ����h4�I@�      �   E   x�3�4000��"0�O.JM,I�/-N-*�/IL�I�4�2�PhS�����
Wh����0+?	a`� ��$      �   e   x�3�JM/��I,⴨PH-*I�-M��4Tp*�� �g`���i�e�P�X���X����iUn����r�馦0�&(�s�hha��ǐ+F��� �8      �      x������ � �      �   �  x�Օ[��8ǟ'���VZ%��V}�� abSs	��d��K���L�j�Ү��Y��o��s���foV��TE~Ml�AV����%�Ͷ2A�V������C��1��)Ͻ��ݙÄc�7��������a���v&By
%�݃I��7�eE�I\��939��8\���Lf@x�%�:T��X����	�T���.:F��[ͻ=��j;�Kk���e�l-�C�#��\S���{����@��.��<͑+�ە%�~��hi��5���.���vfc�b�dW��V"�Sns .�̆H�I�2�y/mn*�߁��4�3p�VJK�	BW�9�5��.�Ydx�P]\zB�{p���X_x��}�/}�?�^���� 	uv(���v~/%�G���; CY�9�+��k�(���\�@�8Z.�}!|��n���v��R���-Y�T-�.m����l�uݴ}��ϩi\������<V�MkK�e`��1k|����e��5��v��)ؕ:ķW����h�z>�y:8��@��q�"�z���B_� ���O@dt<�A7j���s^����Q:,�E�m⍮ǅ���xw�u~V$��Epzk޾3���+q"�����2;�R°���Vc��-Y���%1hD�T@p���� T��b})����pS�k�л�&������`�-��7E���N�e_�ʩH`�S������JĈ��~�׶�!�
��C(��\'��t)�Im��K�\��(ɿXgEI�������̍HX��6��s��R?�A���r���V�ٖ}����t�Tz����w�1nk�Z�� N.i�da������ً��;�t+Ϲ&���;����)"�`E��'ZZB�y��Y�����d[y7Zv����rsF<M�������{	���c�g���a�����B�61ܲ���&  +���t2�|�.�      �   7  x���Aj�0E��S�	�G3��t�eWݥi)�P�G�����+����5�J�����9�q���$,�v����%�k�|9�����k�TI����VH������r��jv*V.!��������_x"�N� �@�����L��7r����5����\u#��d_'6��	����� ��*Y�$HQ�L���3�w�i[P��;۴sP;{I�k���Op��5���m�ST��;[��X�iCj�Imi�R�[��0�����������:h�Zcy���6��:�p�����X�Y�6eވ?�I ������Q����֣-t      �      x������ � �     