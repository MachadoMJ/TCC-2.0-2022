---------------------------------
--- ESQUEMA ESTRUTURAL ADMLTE ---
---------------------------------
	--RESETANDO O ESQUEMA
		use db_AdmLTE
		drop table if exists Sale; 
		drop table if exists TR_Sale; 
		drop table if exists Product; 
		drop table if exists Category; 
		drop table if exists log.tmp_log; 
		drop table if exists Client; 

	--Tentar criar os indeces da PK inclindo o campo name
	--TABLE DE USUARIO
		create table Client (
				Id			int				not null identity(1,1),
				Name		varchar(50)		not null,
				Login		varchar(25)		not null,
				Pass		varchar(20)		not null,
				Img			varchar(100)	not null,
				Register	datetime		not null default getdate(),
				Type		char(1)			not null,
			
				constraint CK_Client_type
					check (type = 'A' or type = 'V' or type = 'U'),

				constraint UQ_Name_Client
					unique (login),			

				constraint PK_Client_id
					primary key(Id)
		);

		insert into  Client (name, Login, Pass, Img, Type)
			values ('Administrador', 'Adm', '321', 'image/user/adm.png', 'A')
		insert into  Client (name, Login, Pass, Img, Type)
			values ('Vendedor', 'seller', '123', 'image/user/seller.png', 'V')
		insert into  Client (name, Login, Pass, Img, Type)
			values ('Usuario', 'User', '123', 'image/user/adm.png', 'U')


	--TABLE DE CATEGORIA
		create table Category (
			Id			int				not null identity(1,1),
			Name		varchar(50)		not null,
			Client		int				not null, --FK
			Register	datetime		not null default getdate(),

			constraint PK_Category_id
				primary key (id),

			constraint FK_Client_Category_id
				foreign key (Client)
					references Client(id) 
					on update cascade 
					
		);
	
	--TABLE DE PRODUTOS
		create table Product (
			Id			int				not null identity(1,1),
			Name		varchar(50)		not null,
			Category	int				not null, --FK
			Img			varchar(100)	not null,
			Price		money			not null,
			Register	datetime		not null default getdate(),
			Client		int				not null, --FK
			Descri		varchar(100)	null,

			constraint PK_Product_id
				primary key (id desc),

			constraint FK_Category_Product_Category
				foreign key (Category)
					references Category(Id)
						on delete cascade,

			constraint FK_Client_Product_Client
				foreign key (Client)
					references Client(id)
					on update cascade
					
		)

	--TABLE DE VENDAS (Garantir a integridade)
		create table TR_Sale (
			Client		int				not null, --FK
			Product		int				not null, --FK
			Amount		int				not null,
			Register	datetime		not null default getdate(),

			constraint PK_TRSale_Register
				primary key (Register desc),

			constraint FK_TbClient_TbSale_Client
				foreign key (Client)
					references Client(Id),

			constraint FK_TbProduct_TbSale_Product
				foreign key (Product)
					references Product(id)
		)
		go

	--TABLE DE VENDAS
		create table Sale (
			Client		int				not null,
			Product		int				not null,
			Amount		int				not null,
			Price		money			not null,
			Register	datetime		not null default getdate(),

			constraint PK_Sale_Register
				primary key (Register desc)
			)
		go

	--trigger que move os dados de uma tabela a outra
		create trigger TR_Move_Reg
			on TR_sale
		after insert
		as
			insert into Sale
				select 
					I.Client,
					I.Product,
					I.Amount,
					P.Price*I.amount, --calcula o valor da venda
					I.Register
				from inserted I
				join product P
					on P.id = I.Product

			delete TR_sale where register = (select register from inserted)
		go

	--TABLE DE LOG
		--drop schema if exists log;
		--create schema log;	
		
		create table log.tmp_log (
			Client		int				not null, --FK
			Action		varchar(55)		not null,
			calendar	varchar(10)		not null,--table
			Register	datetime		not null default getdate(),

			constraint PK_tmplog_IdClient
				primary key (Register desc)
					
		)

---------------------------
--- ESQUEMA ADMLTE VIEW ---
---------------------------
	--DELETANDO
		--adm
		drop view if exists VW_Adm_venda;
		drop view if exists VW_Adm_produto;
		drop view if exists VW_Adm_usuario;
		drop view if exists VW_Adm_VendaValor;
		drop view if exists VW_Adm_tableUser;
		--vendedor
		drop view if exists VW_Sllr_venda;
		drop view if exists VW_Sllr_produto;
		drop view if exists VW_Sllr_User;
		drop view if exists VW_Sllr_VendaValor;
		--usuario
		drop view if exists VW_User_Sale;
		drop view if exists VW_User_ProductQtd;
		drop view if exists VW_User_SaleVl;
		drop view if exists VW_User_AmoutQtd;
		-- adm e vendedor
		drop view if exists VW_TableCategory;
		drop view if exists VW_tableProduct;
		drop view if exists VW_Radio_category;
		drop view if exists VW_update_product;
		-- Sale
		drop view if exists VW_Gallery_Category;
		drop view if exists VW_Gallery_Product;
		drop view if exists VW_Contacts_Product;



	go
	--QTD VENDAS
	create view VW_Adm_venda as
		select count(Register) qtd from sale;
	go
	--QTD PRODUTOS JÁ VENDIDOS
	create view VW_Adm_produto as
		select count(distinct Product) qtd from Sale;
		go
		create index IX_Sale_prod on sale (product)

	go
	--QTD USUARIOS
	create view VW_Adm_usuario as
		select COUNT( distinct Client ) qtd	from Sale;
		go	
		create index IX_Sale_Client on sale (Client)
	go
	--VALOR TOTAL
	create view VW_Adm_VendaValor as
		select 
			ROUND(sum(Price),2) pic
		from Sale S
	go

	--TABELA DE USUARIOS
	Create View VW_Adm_tableUser as
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
	go

	--QTD DE VENDAS POR VENDEDOR
	create view VW_Sllr_venda as
		select 
			p.Client,
			count(s.Register) sale
		from sale S
		join Product P
			on p.Id = S.Product
		group by p.Client;
	go

	--QTD DE PRODUTOS POR VENDEDOR
	create view VW_Sllr_produto as
		select 
			p.Client,
			COUNT(distinct p.Id) prod
		from Product p
		join Sale s
			on s.Product = p.Id
		group by p.Client
	go

	--QTD DE USUARIO QUE COMPRARAM
	create view VW_Sllr_User as
		select 
			P.Client,
			COUNT(distinct S.Client) qtd
		from sale S
		join Product P
			on p.Id = S.Product
		group by P.Client;
		-- index nas foreign key
	go

	--VALOR TOTAL DE CADA VENDEDOR
	create view VW_Sllr_VendaValor as
		select 
			p.Client,
			SUM( S.Price ) pric
		from sale S
		join Product P
			on p.Id = S.Product
		group by p.Client
	go

	--VALOR DE VENDA POR CLIENTE
	create view VW_User_Sale as
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

		go
		create index IX_Sale_client on Sale (client) include (product, amount, register)
		go
		create index IX_Product_Id on Product (id) include (name, price)
	go

	--QUANTIDADE DE PRODUDOS COMPRADOS
	create view VW_User_ProductQtd as
		select 
			s.Client,
			COUNT( distinct p.Id ) qtdProdutos
		from sale S
		join Product P
			on p.Id = S.Product
		group by s.Client
	go

	--VALOR TOTAL DE PRODUTOS COMPRADOS
	create view VW_User_SaleVl as
		select 
			s.Client,
			sum( Amount * p.Price ) vlclient
		from sale S
		join Product P
			on p.Id = S.Product
		group by s.Client
	go

	--QUANTIDADE TOTAL DE PRODUTOS COMPRADOS UNIDADE
	create view VW_User_AmoutQtd as
		select 
			s.Client,
			sum( Amount ) QtdAmountProduct
		from sale S
		join Product P
			on p.Id = S.Product
		group by s.Client
	go

	--DADOS SOBRE AS CATEGORIA
	create View VW_TableCategory as
		select 
			Ca.Name							as Ncategory,
			Ca.Id							as Idcategory,
			CONVERT(char(19), Ca.Register)	as register,
			Cl.Name							as Nclient,
			Cl.Id							as Idclient
		from Category Ca
		join Client Cl
			on Ca.Client = Cl.Id
	go

	--DADOS SOBRE OS PRODUTOS
	create view VW_tableProduct as
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
	go


	create view VW_Radio_category as
		select 
			Name,
			Client,
			id
		from Category

		go

		create index IX_Category_NameClient on category (name, Client)
	go

	create view VW_update_product as
		select 
			name, 
			Descri, 
			Price,
			Id
		from Product
	go

	create view VW_Gallery_Category as
	select 
		id,
		UPPER( name) name
	from Category
	go

	create view VW_Gallery_Product as
	select top 6
		id,
		upper(name) as Nproduct,
		Img
	from Product
	go

	create view VW_Contacts_Product as
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
	go

--------------------------------
--- ESQUEMA ADMLTE PROCEDURE ---
--------------------------------
	--DELETANDO
		--user
		drop proc if exists PRC_Delete_user;
		--categoria
		drop proc if exists PRC_Insert_Category;
		drop proc if exists PRC_Delete_category;
		drop proc if exists PRC_Update_category;
		--produto
		drop proc if exists PRC_Delete_product;
		drop proc if exists PRC_Insert_product;
		drop proc if exists PRC_Update_product;
		--Sale 
		drop proc if exists PRC_Insert_Sale;


		go


	create procedure PRC_Delete_user @IdClient int as
		begin-- movimentar as depencias das outras tabelas para o user adm
			update Category set Client = 1 where Client = @IdClient; --Dependencia Categoria

				insert into log.tmp_log (Client,Action,calendar)
					values (1,'Transf Depen ' + CONVERT(varchar(5),@IdClient) + ' -> 1','Category')

			update Product	set Client = 1 where Client = @IdClient; --Dependencia Produto

				insert into log.tmp_log (Client,Action,calendar)
					values (1,'Transf Depen ' + CONVERT(varchar(5),@IdClient) + ' -> 1','Product')

			delete Client where id = @IdClient; -- deletando o usuario
		end;
	go

	create procedure PRC_Insert_Category @name varchar(50), @client int as	
		begin --inserir categoria
			insert into Category (Name,Client)
				values (@name, @client)

		end;
	go


	create procedure PRC_Delete_category @IdCategory int as
		begin
			delete from Category where id = @IdCategory
		end
	go
		
	create procedure PRC_Update_category @NewName varchar(50), @IdCategory int as
		begin
			update Category
				set Name = @NewName
			where Id = @IdCategory
		end
	go

	create procedure PRC_Delete_product @idProduct int as
		begin
			delete from Product where id = @idProduct
		end
	go


	create procedure PRC_Insert_product @name varchar(50), @category int, @img varchar(100), @price money, @client int ,@desc varchar(100) as
		begin
			insert into Product (Name,Category,Img,Price,Client,Descri)
				values (@name,@category,@img,@price,@client,@desc)
		end
	go

	create procedure PRC_Update_product @name varchar(50), @category int, @img varchar(100), @price money, @desc varchar(100), @id int as
		begin
			update Product
			   set Name		= @name,
				   Category = @category,
				   Img		= @img,
				   Price	= @price,
				   Descri	= @desc
			 where Id = @id
		end
	go

	create procedure PRC_Insert_Sale @client int, @product int, @amount int	as
		begin 
			insert into TR_Sale (Client,Product,Amount)
				values (@client,@product,@amount)
		end



