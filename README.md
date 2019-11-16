# Magic-adt-sql
framework sederhana khusus untuk pemograman android studio

Tambahkan file .htaccess satufolder dengan index.php

Options -Multiviews

RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d

RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^(.*)$ index.php?url=$1 [L] 


Script Class Database

package com.egooktafanda.crud_master.Database;

public class Database {
    public String Databases ="Localhost,root,,android";
    public String[] getSql = {};
  String[] Table = {
    "tb_pegawai,Mahasiswa"
  };

  String[] values = {
          "id => INT(11) AUTO_INCREMENT PRIMARY KEY," +
                  "nama => VARCHAR(100)," +
                  "posisi => VARCHAR(100)," +
                  "gajih => VARCHAR(100)",
          "id => INT(11) AUTO_INCREMENT PRIMARY KEY," +
                  "nama => VARCHAR(100)," +
                  "alamat => VARCHAR(100)"
  };

  public void setSQL(String[] sql){
        this.getSql = sql;
  }
  public String getSql(){
      String getSQ = "";
      for (int i=0;i<getSql.length;i++){
          getSQ += getSql[i]+"/";
      }
      int  fl = getSQ.length();
      return getSQ.substring(0, fl-1);
  }

    public String databases_fild(){
        String fild = "";
        for (int i=0;i<values.length;i++){
            fild += values[i]+"/";
        }
        int  fl = fild.length();
        return fild.substring(0, fl-1);
    }
    public String Tables(){
        String tbl = "";
        for (int i=0;i<Table.length;i++){
            tbl += Table[i]+",";
        }
        int tb = tbl.length();
        return tbl.substring(0, tb-1);
    }

}



