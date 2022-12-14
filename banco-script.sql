/*    ==Scripting Parameters==

    Source Server Version : SQL Server 2019 (15.0.2095)
    Source Database Engine Edition : Microsoft SQL Server Enterprise Edition
    Source Database Engine Type : Standalone SQL Server

    Target Server Version : SQL Server 2019
    Target Database Engine Edition : Microsoft SQL Server Enterprise Edition
    Target Database Engine Type : Standalone SQL Server
*/
USE [master]
GO
/****** Object:  Database [db_AdmLTE]    Script Date: 18/11/2022 18:38:08 ******/
CREATE DATABASE [db_AdmLTE]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'db_AdmLTE', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\db_AdmLTE.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'db_AdmLTE_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL15.MSSQLSERVER\MSSQL\DATA\db_AdmLTE_log.ldf' , SIZE = 73728KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT
GO
ALTER DATABASE [db_AdmLTE] SET COMPATIBILITY_LEVEL = 150
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [db_AdmLTE].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [db_AdmLTE] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [db_AdmLTE] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [db_AdmLTE] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [db_AdmLTE] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [db_AdmLTE] SET ARITHABORT OFF 
GO
ALTER DATABASE [db_AdmLTE] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [db_AdmLTE] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [db_AdmLTE] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [db_AdmLTE] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [db_AdmLTE] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [db_AdmLTE] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [db_AdmLTE] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [db_AdmLTE] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [db_AdmLTE] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [db_AdmLTE] SET  ENABLE_BROKER 
GO
ALTER DATABASE [db_AdmLTE] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [db_AdmLTE] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [db_AdmLTE] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [db_AdmLTE] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [db_AdmLTE] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [db_AdmLTE] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [db_AdmLTE] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [db_AdmLTE] SET RECOVERY FULL 
GO
ALTER DATABASE [db_AdmLTE] SET  MULTI_USER 
GO
ALTER DATABASE [db_AdmLTE] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [db_AdmLTE] SET DB_CHAINING OFF 
GO
ALTER DATABASE [db_AdmLTE] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [db_AdmLTE] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [db_AdmLTE] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [db_AdmLTE] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'db_AdmLTE', N'ON'
GO
ALTER DATABASE [db_AdmLTE] SET QUERY_STORE = OFF
GO
/* For security reasons the login is created disabled and with a random password. */
/****** Object:  Login [test]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [test] WITH PASSWORD=N'UaSnfFSOiRP92ATwKs22p2CQDNtCL4k5COAxmvmkbRE=', DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)], CHECK_EXPIRATION=OFF, CHECK_POLICY=OFF
GO
ALTER LOGIN [test] DISABLE
GO
/****** Object:  Login [S145-MACHADO\Jonat]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [S145-MACHADO\Jonat] FROM WINDOWS WITH DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)]
GO
/****** Object:  Login [NT SERVICE\Winmgmt]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [NT SERVICE\Winmgmt] FROM WINDOWS WITH DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)]
GO
/****** Object:  Login [NT SERVICE\SQLWriter]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [NT SERVICE\SQLWriter] FROM WINDOWS WITH DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)]
GO
/****** Object:  Login [NT SERVICE\SQLTELEMETRY]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [NT SERVICE\SQLTELEMETRY] FROM WINDOWS WITH DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)]
GO
/****** Object:  Login [NT SERVICE\SQLSERVERAGENT]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [NT SERVICE\SQLSERVERAGENT] FROM WINDOWS WITH DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)]
GO
/****** Object:  Login [NT Service\MSSQLSERVER]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [NT Service\MSSQLSERVER] FROM WINDOWS WITH DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)]
GO
/****** Object:  Login [AUTORIDADE NT\SISTEMA]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [AUTORIDADE NT\SISTEMA] FROM WINDOWS WITH DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)]
GO
/* For security reasons the login is created disabled and with a random password. */
/****** Object:  Login [APP]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [APP] WITH PASSWORD=N'ibetRvacBkum79UOCLv05udoJSHY+OSLd4VPXjIaAzI=', DEFAULT_DATABASE=[SUCOS_VENDAS], DEFAULT_LANGUAGE=[Português], CHECK_EXPIRATION=OFF, CHECK_POLICY=OFF
GO
ALTER LOGIN [APP] DISABLE
GO
/* For security reasons the login is created disabled and with a random password. */
/****** Object:  Login [##MS_PolicyTsqlExecutionLogin##]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [##MS_PolicyTsqlExecutionLogin##] WITH PASSWORD=N'dyNi6K738waNRu2pCZRHYKWJhB1Kh6HHUSRffzA5r8w=', DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[us_english], CHECK_EXPIRATION=OFF, CHECK_POLICY=ON
GO
ALTER LOGIN [##MS_PolicyTsqlExecutionLogin##] DISABLE
GO
/* For security reasons the login is created disabled and with a random password. */
/****** Object:  Login [##MS_PolicyEventProcessingLogin##]    Script Date: 18/11/2022 18:38:08 ******/
CREATE LOGIN [##MS_PolicyEventProcessingLogin##] WITH PASSWORD=N'QE55mYgRXbiZ+uapn1qu+4H3uR/HQQnLOls1mzIIImo=', DEFAULT_DATABASE=[master], DEFAULT_LANGUAGE=[Português (Brasil)], CHECK_EXPIRATION=OFF, CHECK_POLICY=ON
GO
ALTER LOGIN [##MS_PolicyEventProcessingLogin##] DISABLE
GO
ALTER AUTHORIZATION ON DATABASE::[db_AdmLTE] TO [S145-MACHADO\Jonat]
GO
ALTER SERVER ROLE [setupadmin] ADD MEMBER [test]
GO
ALTER SERVER ROLE [processadmin] ADD MEMBER [test]
GO
ALTER SERVER ROLE [sysadmin] ADD MEMBER [S145-MACHADO\Jonat]
GO
ALTER SERVER ROLE [sysadmin] ADD MEMBER [NT SERVICE\Winmgmt]
GO
ALTER SERVER ROLE [sysadmin] ADD MEMBER [NT SERVICE\SQLWriter]
GO
ALTER SERVER ROLE [sysadmin] ADD MEMBER [NT SERVICE\SQLSERVERAGENT]
GO
ALTER SERVER ROLE [sysadmin] ADD MEMBER [NT Service\MSSQLSERVER]
GO
USE [db_AdmLTE]
GO
/****** Object:  User [APP]    Script Date: 18/11/2022 18:38:08 ******/
CREATE USER [APP] FOR LOGIN [APP] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [APP]
GO
ALTER ROLE [db_datareader] ADD MEMBER [APP]
GO
ALTER ROLE [db_datawriter] ADD MEMBER [APP]
GO
GRANT CONNECT TO [APP] AS [dbo]
GO
GRANT VIEW ANY COLUMN ENCRYPTION KEY DEFINITION TO [public] AS [dbo]
GO
GRANT VIEW ANY COLUMN MASTER KEY DEFINITION TO [public] AS [dbo]
GO
/****** Object:  Schema [log]    Script Date: 18/11/2022 18:38:08 ******/
CREATE SCHEMA [log] AUTHORIZATION [dbo]
GO
/****** Object:  UserDefinedFunction [dbo].[FN_lista_dias]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE function [dbo].[FN_lista_dias] ()
returns varchar(8000)
begin
	declare @list varchar(8000)
	
	select 
		@list = STRING_AGG(''''+convert(char(10), dat)+'''', ', ')
	from (	select 
				DATEFROMPARTS( YEAR(Register), MONTH(Register),DAY(Register)) dat
			from Sale 
			group by YEAR(Register), MONTH(Register), DAY(Register)  ) as datas

	return @list
end
GO
ALTER AUTHORIZATION ON [dbo].[FN_lista_dias] TO  SCHEMA OWNER 
GO
/****** Object:  UserDefinedFunction [dbo].[FN_lista_preco]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE function [dbo].[FN_lista_preco] ()
returns varchar(8000)
begin
	declare @list varchar(8000)
	
	select 
		@list = STRING_AGG(pric, ', ')
	from (	select 
				sum(Price) pric
			from Sale 
			group by YEAR(Register), MONTH(Register), DAY(Register)) as pric

	return @list
end
GO
ALTER AUTHORIZATION ON [dbo].[FN_lista_preco] TO  SCHEMA OWNER 
GO
/****** Object:  Table [log].[tmp_log]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [log].[tmp_log](
	[Client] [int] NOT NULL,
	[Action] [varchar](55) NOT NULL,
	[calendar] [varchar](10) NOT NULL,
	[Register] [datetime] NOT NULL,
 CONSTRAINT [PK_tmplog_IdClient] PRIMARY KEY CLUSTERED 
(
	[Register] DESC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER AUTHORIZATION ON [log].[tmp_log] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_log_hist]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE view [dbo].[VW_log_hist] as
	select 
		Client,
		Action,
		convert(char(19), Register) reg
	from log.tmp_log
GO
ALTER AUTHORIZATION ON [dbo].[VW_log_hist] TO  SCHEMA OWNER 
GO
/****** Object:  Table [dbo].[Sale]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Sale](
	[Client] [int] NOT NULL,
	[Product] [int] NOT NULL,
	[Amount] [int] NOT NULL,
	[Price] [money] NOT NULL,
	[Register] [datetime] NOT NULL,
 CONSTRAINT [PK_Sale_Register] PRIMARY KEY CLUSTERED 
(
	[Register] DESC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER AUTHORIZATION ON [dbo].[Sale] TO  SCHEMA OWNER 
GO
/****** Object:  Table [dbo].[Client]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Client](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[Name] [varchar](50) NOT NULL,
	[Login] [varchar](25) NOT NULL,
	[Pass] [varchar](20) NOT NULL,
	[Img] [varchar](100) NOT NULL,
	[Register] [datetime] NOT NULL,
	[Type] [char](1) NOT NULL,
 CONSTRAINT [PK_Client_id] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER AUTHORIZATION ON [dbo].[Client] TO  SCHEMA OWNER 
GO
/****** Object:  Table [dbo].[Product]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Product](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[Name] [varchar](50) NOT NULL,
	[Category] [int] NOT NULL,
	[Img] [varchar](100) NOT NULL,
	[Price] [money] NOT NULL,
	[Register] [datetime] NOT NULL,
	[Client] [int] NOT NULL,
	[Descri] [varchar](100) NULL,
 CONSTRAINT [PK_Product_id] PRIMARY KEY CLUSTERED 
(
	[Id] DESC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER AUTHORIZATION ON [dbo].[Product] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Relatory_Sale]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE view [dbo].[VW_Relatory_Sale] as
	select 
		C.Name		as NomeClient,
		P.Name		as NomeProducut,
		S.Price		as Price,
		convert(char(19),S.Register) as register
	from sale S
	join Client C
		on C.Id = S.Client
	join Product P
		on P.Id = S.Product
GO
ALTER AUTHORIZATION ON [dbo].[VW_Relatory_Sale] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Adm_venda]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
	--QTD VENDAS
	create view [dbo].[VW_Adm_venda] as
		select count(Register) qtd from sale;
GO
ALTER AUTHORIZATION ON [dbo].[VW_Adm_venda] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Adm_produto]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
	--QTD PRODUTOS JÁ VENDIDOS
	create view [dbo].[VW_Adm_produto] as
		select count(distinct Product) qtd from Sale;
GO
ALTER AUTHORIZATION ON [dbo].[VW_Adm_produto] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Adm_usuario]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
	--QTD USUARIOS
	create view [dbo].[VW_Adm_usuario] as
		select COUNT( distinct Client ) qtd	from Sale;
GO
ALTER AUTHORIZATION ON [dbo].[VW_Adm_usuario] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Adm_VendaValor]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE view [dbo].[VW_Adm_VendaValor] as
		select 
			ROUND(sum(Price),2) pic
		from Sale S
GO
ALTER AUTHORIZATION ON [dbo].[VW_Adm_VendaValor] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Adm_tableUser]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--TABELA DE USUARIOS
	Create View [dbo].[VW_Adm_tableUser] as
		select 
			Name,
			Login,
			Img,
			CONVERT(char(19), Register) register, 
			Case
				when type = 'A' then 'Administrador'
				when type = 'V' then 'Vendendor'
				when type = 'U' then 'Usuario'
			end Tipo,
			id
		from Client
GO
ALTER AUTHORIZATION ON [dbo].[VW_Adm_tableUser] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Sllr_venda]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--QTD DE VENDAS POR VENDEDOR
	create view [dbo].[VW_Sllr_venda] as
		select 
			p.Client,
			count(s.Register) sale
		from sale S
		join Product P
			on p.Id = S.Product
		group by p.Client;
GO
ALTER AUTHORIZATION ON [dbo].[VW_Sllr_venda] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Sllr_produto]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--QTD DE PRODUTOS POR VENDEDOR
	create view [dbo].[VW_Sllr_produto] as
		select 
			p.Client,
			COUNT(distinct p.Id) prod
		from Product p
		join Sale s
			on s.Product = p.Id
		group by p.Client
GO
ALTER AUTHORIZATION ON [dbo].[VW_Sllr_produto] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Sllr_User]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--QTD DE USUARIO QUE COMPRARAM
	create view [dbo].[VW_Sllr_User] as
		select 
			P.Client,
			COUNT(distinct S.Client) qtd
		from sale S
		join Product P
			on p.Id = S.Product
		group by P.Client;
		-- index nas foreign key
GO
ALTER AUTHORIZATION ON [dbo].[VW_Sllr_User] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Sllr_VendaValor]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE view [dbo].[VW_Sllr_VendaValor] as
		select 
			p.Client,
			SUM( S.Price ) pric
		from sale S
		join Product P
			on p.Id = S.Product
		group by p.Client
GO
ALTER AUTHORIZATION ON [dbo].[VW_Sllr_VendaValor] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_User_Sale]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE view [dbo].[VW_User_Sale] as
		select 
			S.Client					as idClient,
			s.Product					as idProduct,
			max(p.Name)					as NameProd,
			max(P.Price)				as PriceProd,
			sum( P.Price * s.Amount )	as PriceSale,
			max(s.Register)				as Register
		from sale S
		join Product P
			on p.Id = S.Product
		group by s.Client, s.Product
GO
ALTER AUTHORIZATION ON [dbo].[VW_User_Sale] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_User_ProductQtd]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--QUANTIDADE DE PRODUDOS COMPRADOS
	create view [dbo].[VW_User_ProductQtd] as
		select 
			s.Client,
			COUNT( distinct p.Id ) qtdProdutos
		from sale S
		join Product P
			on p.Id = S.Product
		group by s.Client
GO
ALTER AUTHORIZATION ON [dbo].[VW_User_ProductQtd] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_User_SaleVl]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--VALOR TOTAL DE PRODUTOS COMPRADOS
	create view [dbo].[VW_User_SaleVl] as
		select 
			s.Client,
			sum( Amount * p.Price ) vlclient
		from sale S
		join Product P
			on p.Id = S.Product
		group by s.Client
GO
ALTER AUTHORIZATION ON [dbo].[VW_User_SaleVl] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_User_AmoutQtd]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--QUANTIDADE TOTAL DE PRODUTOS COMPRADOS UNIDADE
	create view [dbo].[VW_User_AmoutQtd] as
		select 
			s.Client,
			sum( Amount ) QtdAmountProduct
		from sale S
		join Product P
			on p.Id = S.Product
		group by s.Client
GO
ALTER AUTHORIZATION ON [dbo].[VW_User_AmoutQtd] TO  SCHEMA OWNER 
GO
/****** Object:  Table [dbo].[Category]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Category](
	[Id] [int] IDENTITY(1,1) NOT NULL,
	[Name] [varchar](50) NOT NULL,
	[Client] [int] NOT NULL,
	[Register] [datetime] NOT NULL,
 CONSTRAINT [PK_Category_id] PRIMARY KEY CLUSTERED 
(
	[Id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER AUTHORIZATION ON [dbo].[Category] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_TableCategory]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--DADOS SOBRE AS CATEGORIA
	create View [dbo].[VW_TableCategory] as
		select 
			Ca.Name							as Ncategory,
			Ca.Id							as Idcategory,
			CONVERT(char(19), Ca.Register)	as register,
			Cl.Name							as Nclient,
			Cl.Id							as Idclient
		from Category Ca
		join Client Cl
			on Ca.Client = Cl.Id
GO
ALTER AUTHORIZATION ON [dbo].[VW_TableCategory] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_tableProduct]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	--DADOS SOBRE OS PRODUTOS
	create view [dbo].[VW_tableProduct] as
		select 
			p.Name							as Nproduct,
			p.Id							as Idproduct,
			ca.Name							as Ncategory,
			p.img,
			CONVERT(char(19),p.Register)	as register,
			c.Name							as Nclient,
			c.Id							as Idclient
		from Product P
		join Client C
			on p.Client = c.Id
		join Category Ca
			on Ca.Id = p.Category
GO
ALTER AUTHORIZATION ON [dbo].[VW_tableProduct] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Radio_category]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


	create view [dbo].[VW_Radio_category] as
		select 
			Name,
			Client,
			id
		from Category

GO
ALTER AUTHORIZATION ON [dbo].[VW_Radio_category] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_update_product]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	create view [dbo].[VW_update_product] as
		select 
			name, 
			Descri, 
			Price,
			Id
		from Product
GO
ALTER AUTHORIZATION ON [dbo].[VW_update_product] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Gallery_Category]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	create view [dbo].[VW_Gallery_Category] as
	select 
		id,
		UPPER( name) name
	from Category
GO
ALTER AUTHORIZATION ON [dbo].[VW_Gallery_Category] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Gallery_Product]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	create view [dbo].[VW_Gallery_Product] as
	select top 6
		id,
		upper(name) as Nproduct,
		Img
	from Product
GO
ALTER AUTHORIZATION ON [dbo].[VW_Gallery_Product] TO  SCHEMA OWNER 
GO
/****** Object:  View [dbo].[VW_Contacts_Product]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	create view [dbo].[VW_Contacts_Product] as
		select
			c.Name as Cname,
			p.Name as Pname,
			p.Descri,
			p.Img,
			CONVERT(char(19),p.Register) as register,
			p.Price,
			p.Category,
			p.id as IdPrd
		from Product P
		join Client C
			on p.Client = c.Id
GO
ALTER AUTHORIZATION ON [dbo].[VW_Contacts_Product] TO  SCHEMA OWNER 
GO
/****** Object:  Table [dbo].[TR_Sale]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TR_Sale](
	[Client] [int] NOT NULL,
	[Product] [int] NOT NULL,
	[Amount] [int] NOT NULL,
	[Register] [datetime] NOT NULL,
 CONSTRAINT [PK_TRSale_Register] PRIMARY KEY CLUSTERED 
(
	[Register] DESC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER AUTHORIZATION ON [dbo].[TR_Sale] TO  SCHEMA OWNER 
GO
SET IDENTITY_INSERT [dbo].[Category] ON 

INSERT [dbo].[Category] ([Id], [Name], [Client], [Register]) VALUES (4, N'Peito de Boi', 7, CAST(N'2022-10-21T10:41:34.877' AS DateTime))
INSERT [dbo].[Category] ([Id], [Name], [Client], [Register]) VALUES (5, N'Acém de Boi', 7, CAST(N'2022-10-21T10:41:52.127' AS DateTime))
INSERT [dbo].[Category] ([Id], [Name], [Client], [Register]) VALUES (6, N'Alcatra de Boi', 7, CAST(N'2022-10-21T10:42:07.220' AS DateTime))
INSERT [dbo].[Category] ([Id], [Name], [Client], [Register]) VALUES (7, N'Porco', 9, CAST(N'2022-10-21T10:44:33.627' AS DateTime))
INSERT [dbo].[Category] ([Id], [Name], [Client], [Register]) VALUES (10, N'test', 7, CAST(N'2022-11-17T23:02:15.770' AS DateTime))
SET IDENTITY_INSERT [dbo].[Category] OFF
GO
SET IDENTITY_INSERT [dbo].[Client] ON 

INSERT [dbo].[Client] ([Id], [Name], [Login], [Pass], [Img], [Register], [Type]) VALUES (1, N'Administrador', N'Adm', N'321', N'image/user/adm.png', CAST(N'2022-10-19T20:55:20.807' AS DateTime), N'A')
INSERT [dbo].[Client] ([Id], [Name], [Login], [Pass], [Img], [Register], [Type]) VALUES (6, N'Jonathas Machado', N'Machado', N'123', N'image/user/Machado.png', CAST(N'2022-10-20T00:23:57.887' AS DateTime), N'A')
INSERT [dbo].[Client] ([Id], [Name], [Login], [Pass], [Img], [Register], [Type]) VALUES (7, N'Serginho do Boi', N'Serginho', N'123', N'image/user/Serginho.png', CAST(N'2022-10-20T00:36:35.047' AS DateTime), N'V')
INSERT [dbo].[Client] ([Id], [Name], [Login], [Pass], [Img], [Register], [Type]) VALUES (8, N'açougue da esquina', N'esquina', N'123', N'image/user/esquina.png', CAST(N'2022-10-20T00:38:02.777' AS DateTime), N'U')
INSERT [dbo].[Client] ([Id], [Name], [Login], [Pass], [Img], [Register], [Type]) VALUES (9, N'marcinho do porco', N'marcinho', N'123', N'image/user/marcinho.png', CAST(N'2022-10-21T09:38:58.887' AS DateTime), N'V')
INSERT [dbo].[Client] ([Id], [Name], [Login], [Pass], [Img], [Register], [Type]) VALUES (10, N'Mega Mercado', N'Mega', N'123', N'image/user/Mega.png', CAST(N'2022-10-21T10:39:50.737' AS DateTime), N'U')
INSERT [dbo].[Client] ([Id], [Name], [Login], [Pass], [Img], [Register], [Type]) VALUES (14, N'alciomar', N'mar', N'123', N'image/user/mar.png', CAST(N'2022-11-18T11:26:04.390' AS DateTime), N'U')
SET IDENTITY_INSERT [dbo].[Client] OFF
GO
SET IDENTITY_INSERT [dbo].[Product] ON 

INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (18, N'Carré', 7, N'image/product/Carré7.png', 53.0000, CAST(N'2022-10-21T23:17:11.790' AS DateTime), 9, N'O carré é o lombo, com parte do osso da costela e da coluna vertebral.')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (17, N'Suã', 7, N'image/product/Suã7.png', 98.0000, CAST(N'2022-10-21T23:16:00.567' AS DateTime), 9, N'Uma das melhores partes do porco, o Suã é a coluna vertebral do porco, com um pouco da carne do lomb')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (16, N'Lombo', 7, N'image/product/Lombo7.png', 76.4000, CAST(N'2022-10-21T23:14:14.403' AS DateTime), 9, N'O corte contém uma peça de carne, cilíndrica, com uma pequena camada de gordura.')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (15, N'Panceta', 7, N'image/product/Panceta7.png', 97.5900, CAST(N'2022-10-21T23:12:57.650' AS DateTime), 9, N'A panceta é extraída da barriga do porco, porém com menos gordura.')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (14, N'Granito', 4, N'image/Product/Granito4.png', 45.7800, CAST(N'2022-10-21T16:38:06.377' AS DateTime), 7, N'A carne granito nada mais é do que a ponta do peito do animal. Isso mesmo, é um corte retirado do bo')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (13, N'Maçã do peito', 4, N'image/product/Maçã do peito4.png', 82.4000, CAST(N'2022-10-21T13:16:15.173' AS DateTime), 7, N'É um corte do dianteiro do animal e bem conhecido por ser saboroso')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (12, N'Peito Especial', 4, N'image/product/Peito Especial4.png', 48.7000, CAST(N'2022-10-21T13:11:29.310' AS DateTime), 7, N'O peito faz parte do dianteiro bovino, é um corte muito saboroso, perfeito para pratos cozidos.')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (11, N'Alcatra', 6, N'image/product/Alcatra6.png', 60.4000, CAST(N'2022-10-21T11:47:04.707' AS DateTime), 7, N'Esse é um corte bovino nobre, magro e muito versátil para seu utilizada em diversos pratos')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (10, N'Maminha', 6, N'image/product/Maminha6.png', 78.3600, CAST(N'2022-10-21T11:43:06.890' AS DateTime), 7, N'Maminha é considerada uma parte nobre da alcatra, que fica na parte traseira do boi, entre o lombo.')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (9, N'Picanha', 6, N'image/product/Picanha6.png', 165.8600, CAST(N'2022-10-21T11:39:20.333' AS DateTime), 7, N'Tipicamente brasileira, a picanha é um dos cortes bovinos mais macios e festejados no churrasco.')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (8, N'Prime Steak', 5, N'image/product/Prime Steak5.png', 59.7500, CAST(N'2022-10-21T10:56:56.140' AS DateTime), 7, N'Também conhecido como Chuck Steak, ele também é retirado do miolo do Acém (Acém do meio)')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (7, N'Short Rib', 5, N'image/Product/Short Rib5.png', 34.5300, CAST(N'2022-10-21T10:54:31.390' AS DateTime), 7, N'Retirado da 1ª a 5ª costela, o Short Rib é composto pelo Acém do meio com um pequeno osso da costela')
INSERT [dbo].[Product] ([Id], [Name], [Category], [Img], [Price], [Register], [Client], [Descri]) VALUES (6, N'Denver Steak', 5, N'image/Product/Denver Steak5.png', 25.8600, CAST(N'2022-10-21T10:52:46.630' AS DateTime), 7, N' Extraído do miolo do Acém, o Denver é um corte que se destaca pelo seu alto grau de marmoreio.')
SET IDENTITY_INSERT [dbo].[Product] OFF
GO
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (14, 18, 50, 2650.0000, CAST(N'2022-11-18T11:26:44.757' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (12, 17, 5, 490.0000, CAST(N'2022-11-17T22:59:58.863' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (12, 10, 10, 783.6000, CAST(N'2022-11-17T22:57:39.297' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (12, 8, 20, 1195.0000, CAST(N'2022-11-17T22:56:50.597' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (7, 12, 50, 2435.0000, CAST(N'2022-11-16T11:55:19.237' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 18, 20, 1060.0000, CAST(N'2022-11-01T10:53:36.917' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 18, 90, 4770.0000, CAST(N'2022-11-01T10:53:01.233' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 13, 95, 7828.0000, CAST(N'2022-11-01T10:40:53.283' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 16, 80, 6112.0000, CAST(N'2022-11-01T10:34:49.023' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 18, 80, 4240.0000, CAST(N'2022-10-30T23:10:33.907' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 17, 50, 4900.0000, CAST(N'2022-10-29T01:03:33.850' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 9, 800, 132688.0000, CAST(N'2022-10-28T00:42:27.417' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 14, 20, 915.6000, CAST(N'2022-10-27T23:48:50.940' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 8, 3, 179.2500, CAST(N'2022-10-27T23:48:01.833' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 13, 90, 7416.0000, CAST(N'2022-10-22T00:36:42.877' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 18, 95, 5035.0000, CAST(N'2022-10-22T00:35:17.973' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 16, 60, 4584.0000, CAST(N'2022-10-22T00:34:57.797' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 11, 43, 2597.2000, CAST(N'2022-10-21T23:21:52.230' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 6, 360, 9309.6000, CAST(N'2022-10-21T23:21:29.950' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 6, 100, 2586.0000, CAST(N'2022-10-21T23:21:12.623' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 12, 50, 2435.0000, CAST(N'2022-10-21T23:21:01.680' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (10, 14, 350, 16023.0000, CAST(N'2022-10-21T23:20:50.417' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 6, 30, 775.8000, CAST(N'2022-10-21T23:19:24.660' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 8, 8, 478.0000, CAST(N'2022-10-21T23:18:54.823' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 9, 2, 331.7200, CAST(N'2022-10-21T23:18:43.743' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 15, 100, 9759.0000, CAST(N'2022-10-21T23:18:28.073' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (8, 18, 70, 3710.0000, CAST(N'2022-10-21T23:18:09.823' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (7, 8, 5, 298.7500, CAST(N'2022-10-21T11:23:11.500' AS DateTime))
INSERT [dbo].[Sale] ([Client], [Product], [Amount], [Price], [Register]) VALUES (7, 8, 1, 59.7500, CAST(N'2022-10-21T11:22:58.857' AS DateTime))
GO
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (14, N'insert Sale [18] ', N'Sale', CAST(N'2022-11-18T11:26:44.797' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (1, N'Register new user [mar] ', N'Client', CAST(N'2022-11-18T11:26:04.397' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (1, N'Register new user [marcinho] ', N'Client', CAST(N'2022-11-17T23:15:37.143' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (1, N'Delete user [12]', N'Client', CAST(N'2022-11-17T23:07:10.150' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (1, N'Transf Depen 12 -> 1', N'Category', CAST(N'2022-11-17T23:07:10.130' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (7, N'insert Category [test]', N'Category', CAST(N'2022-11-17T23:02:15.780' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (12, N'insert Sale [17] ', N'Sale', CAST(N'2022-11-17T22:59:58.890' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (12, N'insert Sale [10] ', N'Sale', CAST(N'2022-11-17T22:57:39.323' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (12, N'insert Sale [8] ', N'Sale', CAST(N'2022-11-17T22:56:50.627' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (1, N'Register new user [mar] ', N'Client', CAST(N'2022-11-17T22:55:24.450' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (7, N'insert Sale [12] ', N'Sale', CAST(N'2022-11-16T11:55:19.270' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (8, N'insert Sale [18] ', N'Sale', CAST(N'2022-11-01T10:53:36.937' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (8, N'insert Sale [18] ', N'Sale', CAST(N'2022-11-01T10:53:01.420' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (10, N'insert Sale [13] ', N'Sale', CAST(N'2022-11-01T10:40:53.303' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (10, N'insert Sale [16] ', N'Sale', CAST(N'2022-11-01T10:34:49.063' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (1, N'Register new user [mega] ', N'Client', CAST(N'2022-11-01T09:42:38.980' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (10, N'insert Sale [18] ', N'Sale', CAST(N'2022-10-30T23:10:33.927' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (8, N'insert Sale [17] ', N'Sale', CAST(N'2022-10-29T01:03:33.873' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (8, N'insert Sale [9] ', N'Sale', CAST(N'2022-10-28T00:42:27.443' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (10, N'insert Sale [14] ', N'Sale', CAST(N'2022-10-27T23:48:50.963' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (10, N'insert Sale [8] ', N'Sale', CAST(N'2022-10-27T23:48:01.877' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (10, N'insert Sale [13] ', N'Sale', CAST(N'2022-10-22T00:36:42.903' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (10, N'insert Sale [18] ', N'Sale', CAST(N'2022-10-22T00:35:17.997' AS DateTime))
INSERT [log].[tmp_log] ([Client], [Action], [calendar], [Register]) VALUES (10, N'insert Sale [16] ', N'Sale', CAST(N'2022-10-22T00:34:57.820' AS DateTime))
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [IX_Category_NameClient]    Script Date: 18/11/2022 18:38:08 ******/
CREATE NONCLUSTERED INDEX [IX_Category_NameClient] ON [dbo].[Category]
(
	[Name] ASC,
	[Client] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [UQ_Name_Client]    Script Date: 18/11/2022 18:38:08 ******/
ALTER TABLE [dbo].[Client] ADD  CONSTRAINT [UQ_Name_Client] UNIQUE NONCLUSTERED 
(
	[Login] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Product_Id]    Script Date: 18/11/2022 18:38:08 ******/
CREATE NONCLUSTERED INDEX [IX_Product_Id] ON [dbo].[Product]
(
	[Id] ASC
)
INCLUDE([Name],[Price]) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
/****** Object:  Index [IX_Sale_client]    Script Date: 18/11/2022 18:38:08 ******/
CREATE NONCLUSTERED INDEX [IX_Sale_client] ON [dbo].[Sale]
(
	[Client] ASC
)
INCLUDE([Product],[Amount],[Register]) WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, DROP_EXISTING = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
ALTER TABLE [dbo].[Category] ADD  DEFAULT (getdate()) FOR [Register]
GO
ALTER TABLE [dbo].[Client] ADD  DEFAULT (getdate()) FOR [Register]
GO
ALTER TABLE [dbo].[Product] ADD  DEFAULT (getdate()) FOR [Register]
GO
ALTER TABLE [dbo].[Sale] ADD  DEFAULT (getdate()) FOR [Register]
GO
ALTER TABLE [dbo].[TR_Sale] ADD  DEFAULT (getdate()) FOR [Register]
GO
ALTER TABLE [log].[tmp_log] ADD  DEFAULT (getdate()) FOR [Register]
GO
ALTER TABLE [dbo].[Category]  WITH CHECK ADD  CONSTRAINT [FK_Client_Category_id] FOREIGN KEY([Client])
REFERENCES [dbo].[Client] ([Id])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Category] CHECK CONSTRAINT [FK_Client_Category_id]
GO
ALTER TABLE [dbo].[Product]  WITH CHECK ADD  CONSTRAINT [FK_Category_Product_Category] FOREIGN KEY([Category])
REFERENCES [dbo].[Category] ([Id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[Product] CHECK CONSTRAINT [FK_Category_Product_Category]
GO
ALTER TABLE [dbo].[Product]  WITH CHECK ADD  CONSTRAINT [FK_Client_Product_Client] FOREIGN KEY([Client])
REFERENCES [dbo].[Client] ([Id])
ON UPDATE CASCADE
GO
ALTER TABLE [dbo].[Product] CHECK CONSTRAINT [FK_Client_Product_Client]
GO
ALTER TABLE [dbo].[TR_Sale]  WITH CHECK ADD  CONSTRAINT [FK_TbClient_TbSale_Client] FOREIGN KEY([Client])
REFERENCES [dbo].[Client] ([Id])
GO
ALTER TABLE [dbo].[TR_Sale] CHECK CONSTRAINT [FK_TbClient_TbSale_Client]
GO
ALTER TABLE [dbo].[TR_Sale]  WITH CHECK ADD  CONSTRAINT [FK_TbProduct_TbSale_Product] FOREIGN KEY([Product])
REFERENCES [dbo].[Product] ([Id])
GO
ALTER TABLE [dbo].[TR_Sale] CHECK CONSTRAINT [FK_TbProduct_TbSale_Product]
GO
ALTER TABLE [dbo].[Client]  WITH CHECK ADD  CONSTRAINT [CK_Client_type] CHECK  (([type]='A' OR [type]='V' OR [type]='U'))
GO
ALTER TABLE [dbo].[Client] CHECK CONSTRAINT [CK_Client_type]
GO
/****** Object:  StoredProcedure [dbo].[PRC_Delete_category]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


	create procedure [dbo].[PRC_Delete_category] @IdCategory int as
		begin
			delete from Category where id = @IdCategory
		end
GO
ALTER AUTHORIZATION ON [dbo].[PRC_Delete_category] TO  SCHEMA OWNER 
GO
/****** Object:  StoredProcedure [dbo].[PRC_Delete_product]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	create procedure [dbo].[PRC_Delete_product] @idProduct int as
		begin
			delete from Product where id = @idProduct
		end
GO
ALTER AUTHORIZATION ON [dbo].[PRC_Delete_product] TO  SCHEMA OWNER 
GO
/****** Object:  StoredProcedure [dbo].[PRC_Delete_user]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


	create procedure [dbo].[PRC_Delete_user] @IdClient int as
		begin-- movimentar as depencias das outras tabelas para o user adm
			update Category set Client = 1 where Client = @IdClient; --Dependencia Categoria

				insert into log.tmp_log (Client,Action,calendar)
					values (1,'Transf Depen ' + CONVERT(varchar(5),@IdClient) + ' -> 1','Category')

			update Product	set Client = 1 where Client = @IdClient; --Dependencia Produto

				insert into log.tmp_log (Client,Action,calendar)
					values (1,'Transf Depen ' + CONVERT(varchar(5),@IdClient) + ' -> 1','Product')

			delete Client where id = @IdClient; -- deletando o usuario
		end;
GO
ALTER AUTHORIZATION ON [dbo].[PRC_Delete_user] TO  SCHEMA OWNER 
GO
/****** Object:  StoredProcedure [dbo].[PRC_Insert_Category]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	create procedure [dbo].[PRC_Insert_Category] @name varchar(50), @client int as	
		begin --inserir categoria
			insert into Category (Name,Client)
				values (@name, @client)

		end;
GO
ALTER AUTHORIZATION ON [dbo].[PRC_Insert_Category] TO  SCHEMA OWNER 
GO
/****** Object:  StoredProcedure [dbo].[PRC_Insert_product]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


	create procedure [dbo].[PRC_Insert_product] @name varchar(50), @category int, @img varchar(100), @price money, @client int ,@desc varchar(100) as
		begin
			insert into Product (Name,Category,Img,Price,Client,Descri)
				values (@name,@category,@img,@price,@client,@desc)
		end
GO
ALTER AUTHORIZATION ON [dbo].[PRC_Insert_product] TO  SCHEMA OWNER 
GO
/****** Object:  StoredProcedure [dbo].[PRC_Insert_Sale]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	create procedure [dbo].[PRC_Insert_Sale] @client int, @product int, @amount int	as
		begin 
			insert into TR_Sale (Client,Product,Amount)
				values (@client,@product,@amount)
		end



GO
ALTER AUTHORIZATION ON [dbo].[PRC_Insert_Sale] TO  SCHEMA OWNER 
GO
/****** Object:  StoredProcedure [dbo].[PRC_InsertCategory]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create procedure [dbo].[PRC_InsertCategory] @name varchar(50), @client int
as
begin --inserir categoria
	insert into Category (Name,Client)
		values (@name, @client)

end;
GO
ALTER AUTHORIZATION ON [dbo].[PRC_InsertCategory] TO  SCHEMA OWNER 
GO
/****** Object:  StoredProcedure [dbo].[PRC_Update_category]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
		
	create procedure [dbo].[PRC_Update_category] @NewName varchar(50), @IdCategory int as
		begin
			update Category
				set Name = @NewName
			where Id = @IdCategory
		end
GO
ALTER AUTHORIZATION ON [dbo].[PRC_Update_category] TO  SCHEMA OWNER 
GO
/****** Object:  StoredProcedure [dbo].[PRC_Update_product]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

	create procedure [dbo].[PRC_Update_product] @name varchar(50), @category int, @img varchar(100), @price money, @desc varchar(100), @id int as
		begin
			update Product
			   set Name		= @name,
				   Category = @category,
				   Img		= @img,
				   Price	= @price,
				   Descri	= @desc
			 where Id = @id
		end
GO
ALTER AUTHORIZATION ON [dbo].[PRC_Update_product] TO  SCHEMA OWNER 
GO
/****** Object:  Trigger [dbo].[TR_Move_Reg]    Script Date: 18/11/2022 18:38:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
		CREATE trigger [dbo].[TR_Move_Reg]
			on [dbo].[TR_Sale]
		after insert
		as
			insert into Sale
				select 
					I.Client,
					I.Product,
					I.Amount,
					P.Price*I.amount,
					I.Register
				from inserted I
				join product P
					on P.id = I.Product

			delete TR_sale where register = (select register from inserted)
GO
ALTER TABLE [dbo].[TR_Sale] ENABLE TRIGGER [TR_Move_Reg]
GO
USE [master]
GO
ALTER DATABASE [db_AdmLTE] SET  READ_WRITE 
GO
