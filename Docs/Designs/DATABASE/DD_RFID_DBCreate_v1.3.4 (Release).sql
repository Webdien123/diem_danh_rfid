/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     24-11-17 3:40:22 PM                          */
/*==============================================================*/


drop table if exists CANBO;

drop table if exists CHUYENNGANH;

drop table if exists DANGKYTHECB;

drop table if exists DANGKYTHESV;

drop table if exists DIEMDANHCB;

drop table if exists DIEMDANHSV;

drop table if exists KHOAHOC;

drop table if exists KHOA_PHONG;

drop table if exists KYHIEULOP;

drop table if exists LOAIDS;

drop table if exists SINHVIEN;

drop table if exists SUKIEN;

drop table if exists THONGKEDIEMDANH;

drop table if exists TO_BOMON;

drop table if exists TRANGTHAISK;

/*==============================================================*/
/* Table: CANBO                                                 */
/*==============================================================*/
create table CANBO
(
   MSCB                 char(8) not null,
   TENKHOA              varchar(50) not null,
   HOTEN                varchar(50) not null default '--',
   TENBOMON             varchar(50) not null default '--',
   EMAIL                varchar(50) not null default '--',
   primary key (MSCB)
);

/*==============================================================*/
/* Table: CHUYENNGANH                                           */
/*==============================================================*/
create table CHUYENNGANH
(
   TENKHOA              varchar(50) not null,
   TENCHNGANH           varchar(50) not null,
   primary key (TENKHOA, TENCHNGANH)
);

/*==============================================================*/
/* Table: DANGKYTHECB                                           */
/*==============================================================*/
create table DANGKYTHECB
(
   MSCB_THE             char(8) not null,
   MATHE                varchar(10) not null,
   primary key (MSCB_THE)
);

/*==============================================================*/
/* Table: DANGKYTHESV                                           */
/*==============================================================*/
create table DANGKYTHESV
(
   MSSV_THE             char(8) not null,
   MATHE                varchar(10) not null,
   primary key (MSSV_THE)
);

/*==============================================================*/
/* Table: DIEMDANHCB                                            */
/*==============================================================*/
create table DIEMDANHCB
(
   MASK                 int not null,
   MSCB                 char(8) not null,
   MALOAIDS             int not null,
   primary key (MASK, MSCB)
);

/*==============================================================*/
/* Table: DIEMDANHSV                                            */
/*==============================================================*/
create table DIEMDANHSV
(
   MSSV                 char(8) not null,
   MASK                 int not null,
   MALOAIDS             int not null,
   primary key (MSSV, MASK)
);

/*==============================================================*/
/* Table: KHOAHOC                                               */
/*==============================================================*/
create table KHOAHOC
(
   KHOAHOC              char(3) not null,
   primary key (KHOAHOC)
);

/*==============================================================*/
/* Table: KHOA_PHONG                                            */
/*==============================================================*/
create table KHOA_PHONG
(
   TENKHOA              varchar(50) not null,
   primary key (TENKHOA)
);

/*==============================================================*/
/* Table: KYHIEULOP                                             */
/*==============================================================*/
create table KYHIEULOP
(
   KYHIEULOP            char(2) not null,
   primary key (KYHIEULOP)
);

/*==============================================================*/
/* Table: LOAIDS                                                */
/*==============================================================*/
create table LOAIDS
(
   MALOAIDS             int not null auto_increment,
   TENLOAIDS            varchar(50) not null,
   primary key (MALOAIDS)
);

/*==============================================================*/
/* Table: SINHVIEN                                              */
/*==============================================================*/
create table SINHVIEN
(
   MSSV                 char(8) not null,
   TENKHOA              varchar(50) not null,
   HOTEN                varchar(50) not null default '--',
   TENCHNGANH           varchar(50) not null default '--',
   KYHIEULOP            char(2) not null default '--',
   KHOAHOC              char(3) not null default '--',
   primary key (MSSV)
);

/*==============================================================*/
/* Table: SUKIEN                                                */
/*==============================================================*/
create table SUKIEN
(
   MASK                 int not null auto_increment,
   MATTHAI              int not null default 1,
   TENSK                varchar(50) not null,
   NGTHUCHIEN           date not null,
   DIADIEM              varchar(150) not null,
   DDVAO                time not null,
   DDRA                 time not null,
   TGIANDDRA            int not null default 10,
   primary key (MASK)
);

/*==============================================================*/
/* Table: THONGKEDIEMDANH                                       */
/*==============================================================*/
create table THONGKEDIEMDANH
(
   MALOAIDS             int not null,
   MASK                 int not null,
   SOLUONGSV            int default 0,
   SOLUONGCB            int default 0,
   primary key (MALOAIDS, MASK)
);

/*==============================================================*/
/* Table: TO_BOMON                                              */
/*==============================================================*/
create table TO_BOMON
(
   TENKHOA              varchar(50) not null,
   TENBOMON             varchar(50) not null,
   primary key (TENKHOA, TENBOMON)
);

/*==============================================================*/
/* Table: TRANGTHAISK                                           */
/*==============================================================*/
create table TRANGTHAISK
(
   MATTHAI              int not null,
   GHICHU               varchar(50) not null,
   primary key (MATTHAI)
);

alter table CANBO add constraint FK_BOMONCB foreign key (TENKHOA, TENBOMON)
      references TO_BOMON (TENKHOA, TENBOMON) on delete restrict on update restrict;

alter table CHUYENNGANH add constraint FK_KHOACHNGANH foreign key (TENKHOA)
      references KHOA_PHONG (TENKHOA) on delete restrict on update restrict;

alter table DANGKYTHECB add constraint FK_DANGKYTHECB foreign key (MSCB_THE)
      references CANBO (MSCB) on delete restrict on update restrict;

alter table DANGKYTHESV add constraint FK_DANGKYTHESV foreign key (MSSV_THE)
      references SINHVIEN (MSSV) on delete restrict on update restrict;

alter table DIEMDANHCB add constraint FK_DIEMDANHCB foreign key (MSCB)
      references CANBO (MSCB) on delete restrict on update restrict;

alter table DIEMDANHCB add constraint FK_LOAIDS_DSCB foreign key (MALOAIDS)
      references LOAIDS (MALOAIDS) on delete restrict on update restrict;

alter table DIEMDANHCB add constraint FK_SKIENDDCB foreign key (MASK)
      references SUKIEN (MASK) on delete restrict on update restrict;

alter table DIEMDANHSV add constraint FK_DIEMDANHSV foreign key (MSSV)
      references SINHVIEN (MSSV) on delete restrict on update restrict;

alter table DIEMDANHSV add constraint FK_LOAIDS_DSSV foreign key (MALOAIDS)
      references LOAIDS (MALOAIDS) on delete restrict on update restrict;

alter table DIEMDANHSV add constraint FK_SKIENDDSV foreign key (MASK)
      references SUKIEN (MASK) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_KHOAHOCSV foreign key (KHOAHOC)
      references KHOAHOC (KHOAHOC) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_LOPSV foreign key (KYHIEULOP)
      references KYHIEULOP (KYHIEULOP) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_NGANHSV foreign key (TENKHOA, TENCHNGANH)
      references CHUYENNGANH (TENKHOA, TENCHNGANH) on delete restrict on update restrict;

alter table SUKIEN add constraint FK_TTHAISK foreign key (MATTHAI)
      references TRANGTHAISK (MATTHAI) on delete restrict on update restrict;

alter table THONGKEDIEMDANH add constraint FK_THONGKELOAIDS foreign key (MALOAIDS)
      references LOAIDS (MALOAIDS) on delete restrict on update restrict;

alter table THONGKEDIEMDANH add constraint FK_THONGKESK foreign key (MASK)
      references SUKIEN (MASK) on delete restrict on update restrict;

alter table TO_BOMON add constraint FK_KHOABOMON foreign key (TENKHOA)
      references KHOA_PHONG (TENKHOA) on delete restrict on update restrict;

