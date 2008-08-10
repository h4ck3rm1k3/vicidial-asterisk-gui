#!/bin/bash

export FTP_PASSIVE=1

cpan MD5 Digest::MD5 Digest::SHA1 readline
cpan Bundle::CPAN
cpan -f Scalar::Util
cpan DBI
cpan -f DBD::mysql
cpan Net::Telnet Time::HiRes Net::Server Switch Unicode::Map Jcode Spreadsheet::WriteExcel OLE::Storage_Lite Proc::ProcessTable IO::Scalar Spreadsheet::ParseExcel Curses Getopt::Long Net::Domain


