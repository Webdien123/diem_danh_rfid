/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     18-09-17 10:39:40 AM                         */
/*==============================================================*/


drop table if exists CANBO;

drop table if exists CHUYENNGANH;

drop table if exists DANGKYTHECB;

drop table if exists DANGKYTHESV;

drop table if exists DANGTHONGBAO;

drop table if exists DIEMDANHCB;

drop table if exists DIEMDANHSV;

drop table if exists KHOAHOC;

drop table if exists KHOA_PHONG;

drop table if exists KYHIEULOP;

drop table if exists LOAIDS;

drop table if exists LOAITHONGBAO;

drop table if exists SINHVIEN;

drop table if exists SUKIEN;

drop table if exists THONGBAO;

drop table if exists THONGKEDIEMDANH;

drop table if exists TO_BOMON;

/*==============================================================*/
/* Table: CANBO                                                 */
/*==============================================================*/
create table CANBO
(
   MSCB                 char(8) not null,
   TENBOMON             varchar(50) not null,
   TENKHOA              varchar(50) not null,
   EMAIL                varchar(50) not null,
   HOTEN                varchar(50) not null,
   primary key (MSCB)
);

/*==============================================================*/
/* Table: CHUYENNGANH                                           */
/*==============================================================*/
create table CHUYENNGANH
(
   TENCHNGANH           varchar(50) not null,
   TENKHOA              varchar(50) not null,
   primary key (TENCHNGANH)
);

/*==============================================================*/
/* Table: DANGKYTHECB                                           */
/*==============================================================*/
create table DANGKYTHECB
(
   MSCB                 char(8) not null,
   MATHE                varchar(10) not null,
   primary key (MSCB)
);

/*==============================================================*/
/* Table: DANGKYTHESV                                           */
/*==============================================================*/
create table DANGKYTHESV
(
   MSSV                 char(8) not null,
   MATHE                varchar(10) not null,
   primary key (MSSV)
);

/*==============================================================*/
/* Table: DANGTHONGBAO                                          */
/*==============================================================*/
create table DANGTHONGBAO
(
   MATBAO               int not null,
   THOIGIANDANG         datetime not null default CURRENT_TIMESTAMP,
   HOTEN                varchar(50) not null,
   SDT                  varchar(11) not null,
   EMAIL                varchar(50) not null,
   primary key (MATBAO)
);

/*==============================================================*/
/* Table: DIEMDANHCB                                            */
/*==============================================================*/
create table DIEMDANHCB
(
   MALOAIDS             int not null,
   MASK                 int not null,
   MSCB                 char(8) not null,
   primary key (MALOAIDS, MASK, MSCB)
);

/*==============================================================*/
/* Table: DIEMDANHSV                                            */
/*==============================================================*/
create table DIEMDANHSV
(
   MSSV                 char(8) not null,
   MALOAIDS             int not null,
   MASK                 int not null,
   primary key (MSSV, MALOAIDS, MASK)
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
   TENLOAIDS            varchar(30) not null,
   primary key (MALOAIDS)
);

/*==============================================================*/
/* Table: LOAITHONGBAO                                          */
/*==============================================================*/
create table LOAITHONGBAO
(
   MALOAITBAO           int not null auto_increment,
   TENLOAITBAO          varchar(50) not null,
   primary key (MALOAITBAO)
);

/*==============================================================*/
/* Table: SINHVIEN                                              */
/*==============================================================*/
create table SINHVIEN
(
   MSSV                 char(8) not null,
   KYHIEULOP            char(2) not null,
   TENCHNGANH           varchar(50) not null,
   KHOAHOC              char(3) not null,
   TENKHOA              varchar(50) not null,
   HOTEN                varchar(50) not null,
   primary key (MSSV)
);

/*==============================================================*/
/* Table: SUKIEN                                                */
/*==============================================================*/
create table SUKIEN
(
   MASK                 int not null auto_increment,
   TENSK                varchar(50) not null,
   NGTHUCHIEN           date not null,
   DIADIEM              varchar(150) not null,
   DDVAO                time not null,
   DDRA                 time not null,
   primary key (MASK)
);

/*==============================================================*/
/* Table: THONGBAO                                              */
/*==============================================================*/
create table THONGBAO
(
   MATBAO               int not null auto_increment,
   MALOAITBAO           int not null,
   TIEUDE               varchar(50) not null,
   NOIDUNG              varchar(1000),
   DAXULY               bool default false,
   primary key (MATBAO)
);

/*==============================================================*/
/* Table: THONGKEDIEMDANH                                       */
/*==============================================================*/
create table THONGKEDIEMDANH
(
   MALOAIDS             int not null,
   MASK                 int not null,
   SOLUONG              int default 0,
   primary key (MALOAIDS, MASK)
);

/*==============================================================*/
/* Table: TO_BOMON                                              */
/*==============================================================*/
create table TO_BOMON
(
   TENBOMON             varchar(50) not null,
   TENKHOA              varchar(50) not null,
   primary key (TENBOMON)
);

alter table CANBO add constraint FK_BOMONCB foreign key (TENBOMON)
      references TO_BOMON (TENBOMON) on delete restrict on update restrict;

alter table CANBO add constraint FK_KHOACB foreign key (TENKHOA)
      references KHOA_PHONG (TENKHOA) on delete restrict on update restrict;

alter table CHUYENNGANH add constraint FK_KHOACHNGANH foreign key (TENKHOA)
      references KHOA_PHONG (TENKHOA) on delete restrict on update restrict;

alter table DANGKYTHECB add constraint FK_DANGKYTHECB foreign key (MSCB)
      references CANBO (MSCB) on delete restrict on update restrict;

alter table DANGKYTHESV add constraint FK_DANGKYTHESV foreign key (MSSV)
      references SINHVIEN (MSSV) on delete restrict on update restrict;

alter table DANGTHONGBAO add constraint FK_DANGTBAO foreign key (MATBAO)
      references THONGBAO (MATBAO) on delete restrict on update restrict;

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

alter table SINHVIEN add constraint FK_KHOASV foreign key (TENKHOA)
      references KHOA_PHONG (TENKHOA) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_LOPSV foreign key (KYHIEULOP)
      references KYHIEULOP (KYHIEULOP) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_NGANHSV foreign key (TENCHNGANH)
      references CHUYENNGANH (TENCHNGANH) on delete restrict on update restrict;

alter table THONGBAO add constraint FK_LOAITB_TBAO foreign key (MALOAITBAO)
      references LOAITHONGBAO (MALOAITBAO) on delete restrict on update restrict;

alter table THONGKEDIEMDANH add constraint FK_THONGKELOAIDS foreign key (MALOAIDS)
      references LOAIDS (MALOAIDS) on delete restrict on update restrict;

alter table THONGKEDIEMDANH add constraint FK_THONGKESK foreign key (MASK)
      references SUKIEN (MASK) on delete restrict on update restrict;

alter table TO_BOMON add constraint FK_KHOABOMON foreign key (TENKHOA)
      references KHOA_PHONG (TENKHOA) on delete restrict on update restrict;

