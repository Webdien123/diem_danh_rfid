/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     11-09-17 4:45:37 PM                          */
/*==============================================================*/


drop table if exists BOMON;

drop table if exists CANBO;

drop table if exists CHUYENNGANH;

drop table if exists DANGKYTHECB;

drop table if exists DANGKYTHESV;

drop table if exists DANGTHONGBAO;

drop table if exists DSDIEMDANHCB;

drop table if exists DSDIEMDANHSV;

drop table if exists KHOA;

drop table if exists KHOAHOC;

drop table if exists KYHIEULOP;

drop table if exists LOAIDS;

drop table if exists LOAITHONGBAO;

drop table if exists SINHVIEN;

drop table if exists SUKIEN;

drop table if exists THE;

drop table if exists THONGBAO;

/*==============================================================*/
/* Table: BOMON                                                 */
/*==============================================================*/
create table BOMON
(
   TENBOMON             varchar(50) not null,
   primary key (TENBOMON)
);

/*==============================================================*/
/* Table: CANBO                                                 */
/*==============================================================*/
create table CANBO
(
   MSCB                 char(8) not null,
   TENBOMON             varchar(50) not null,
   TENKHOA              varchar(30) not null,
   EMAILCB              varchar(50),
   HOTENCB              varchar(50),
   primary key (MSCB)
);

/*==============================================================*/
/* Table: CHUYENNGANH                                           */
/*==============================================================*/
create table CHUYENNGANH
(
   TENCHNGANH           varchar(50) not null,
   primary key (TENCHNGANH)
);

/*==============================================================*/
/* Table: DANGKYTHECB                                           */
/*==============================================================*/
create table DANGKYTHECB
(
   MATHE                varchar(10) not null,
   MSCB                 char(8) not null,
   primary key (MATHE, MSCB)
);

/*==============================================================*/
/* Table: DANGKYTHESV                                           */
/*==============================================================*/
create table DANGKYTHESV
(
   MSSV                 char(8) not null,
   MATHE                varchar(10) not null,
   primary key (MSSV, MATHE)
);

/*==============================================================*/
/* Table: DANGTHONGBAO                                          */
/*==============================================================*/
create table DANGTHONGBAO
(
   MATBAO               char(8) not null,
   NGAYDANG             date,
   GIODANG              time,
   TENNGDANG            varchar(50),
   SDTNGDANG            varchar(11),
   EMAILNGDANG          varchar(50),
   primary key (MATBAO)
);

/*==============================================================*/
/* Table: DSDIEMDANHCB                                          */
/*==============================================================*/
create table DSDIEMDANHCB
(
   MALOAIDS             char(3) not null,
   MASK                 varchar(10) not null,
   MSCB                 char(8) not null,
   primary key (MALOAIDS, MASK, MSCB)
);

/*==============================================================*/
/* Table: DSDIEMDANHSV                                          */
/*==============================================================*/
create table DSDIEMDANHSV
(
   MSSV                 char(8) not null,
   MALOAIDS             char(3) not null,
   MASK                 varchar(10) not null,
   primary key (MSSV, MALOAIDS, MASK)
);

/*==============================================================*/
/* Table: KHOA                                                  */
/*==============================================================*/
create table KHOA
(
   TENKHOA              varchar(30) not null,
   primary key (TENKHOA)
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
   MALOAIDS             char(3) not null,
   TENLOAIDS            varchar(30) not null,
   primary key (MALOAIDS)
);

/*==============================================================*/
/* Table: LOAITHONGBAO                                          */
/*==============================================================*/
create table LOAITHONGBAO
(
   MALOAITBAO           char(3) not null,
   TENLOAITBAO          varchar(30) not null,
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
   TENKHOA              varchar(30) not null,
   HOTENSV              varchar(50),
   primary key (MSSV)
);

/*==============================================================*/
/* Table: SUKIEN                                                */
/*==============================================================*/
create table SUKIEN
(
   MASK                 varchar(10) not null,
   TENSK                varchar(50),
   NGTHUCHIEN           date,
   DIADIEM              varchar(40),
   DDVAO                time,
   DDRA                 time,
   primary key (MASK)
);

/*==============================================================*/
/* Table: THE                                                   */
/*==============================================================*/
create table THE
(
   MATHE                varchar(10) not null,
   primary key (MATHE)
);

/*==============================================================*/
/* Table: THONGBAO                                              */
/*==============================================================*/
create table THONGBAO
(
   MATBAO               char(8) not null,
   MALOAITBAO           char(3) not null,
   TIEUDE               varchar(40),
   NOIDUNG              varchar(255),
   primary key (MATBAO)
);

alter table CANBO add constraint FK_BOMONCB foreign key (TENBOMON)
      references BOMON (TENBOMON) on delete restrict on update restrict;

alter table CANBO add constraint FK_KHOACB foreign key (TENKHOA)
      references KHOA (TENKHOA) on delete restrict on update restrict;

alter table DANGKYTHECB add constraint FK_DANGKYTHECB foreign key (MSCB)
      references CANBO (MSCB) on delete restrict on update restrict;

alter table DANGKYTHECB add constraint FK_THECBDKTHE foreign key (MATHE)
      references THE (MATHE) on delete restrict on update restrict;

alter table DANGKYTHESV add constraint FK_DANGKYTHESV foreign key (MSSV)
      references SINHVIEN (MSSV) on delete restrict on update restrict;

alter table DANGKYTHESV add constraint FK_THESVDKTHE foreign key (MATHE)
      references THE (MATHE) on delete restrict on update restrict;

alter table DANGTHONGBAO add constraint FK_DANGTBAO foreign key (MATBAO)
      references THONGBAO (MATBAO) on delete restrict on update restrict;

alter table DSDIEMDANHCB add constraint FK_DIEMDANHCB foreign key (MSCB)
      references CANBO (MSCB) on delete restrict on update restrict;

alter table DSDIEMDANHCB add constraint FK_LOAIDS_DSCB foreign key (MALOAIDS)
      references LOAIDS (MALOAIDS) on delete restrict on update restrict;

alter table DSDIEMDANHCB add constraint FK_SKIENDDCB foreign key (MASK)
      references SUKIEN (MASK) on delete restrict on update restrict;

alter table DSDIEMDANHSV add constraint FK_DIEMDANHSV foreign key (MSSV)
      references SINHVIEN (MSSV) on delete restrict on update restrict;

alter table DSDIEMDANHSV add constraint FK_LOAIDS_DSSV foreign key (MALOAIDS)
      references LOAIDS (MALOAIDS) on delete restrict on update restrict;

alter table DSDIEMDANHSV add constraint FK_SKIENDDSV foreign key (MASK)
      references SUKIEN (MASK) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_KHOAHOCSV foreign key (KHOAHOC)
      references KHOAHOC (KHOAHOC) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_KHOASV foreign key (TENKHOA)
      references KHOA (TENKHOA) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_LOPSV foreign key (KYHIEULOP)
      references KYHIEULOP (KYHIEULOP) on delete restrict on update restrict;

alter table SINHVIEN add constraint FK_NGANHSV foreign key (TENCHNGANH)
      references CHUYENNGANH (TENCHNGANH) on delete restrict on update restrict;

alter table THONGBAO add constraint FK_LOAITB_TBAO foreign key (MALOAITBAO)
      references LOAITHONGBAO (MALOAITBAO) on delete restrict on update restrict;

