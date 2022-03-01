we can get sql script before we migrate it to database by 

Script-Migration

IF OBJECT_ID(N'[__EFMigrationsHistory]') IS NULL
BEGIN
    CREATE TABLE [__EFMigrationsHistory] (
        [MigrationId] nvarchar(150) NOT NULL,
        [ProductVersion] nvarchar(32) NOT NULL,
        CONSTRAINT [PK___EFMigrationsHistory] PRIMARY KEY ([MigrationId])
    );
END;
GO

BEGIN TRANSACTION;
GO

CREATE TABLE [Offices] (
    [Id] uniqueidentifier NOT NULL,
    [Name] nvarchar(50) NOT NULL,
    [Address] nvarchar(400) NOT NULL,
    CONSTRAINT [PK_Offices] PRIMARY KEY ([Id])
);
GO

CREATE TABLE [Employees] (
    [Id] uniqueidentifier NOT NULL,
    [RoleInCompany] nvarchar(100) NOT NULL,
    [FullName] nvarchar(50) NOT NULL,
    [Hired] datetimeoffset NOT NULL,
    [Salary] decimal(18,2) NOT NULL,
    [OfficeId] uniqueidentifier NOT NULL,
    CONSTRAINT [PK_Employees] PRIMARY KEY ([Id]),
    CONSTRAINT [FK_Employees_Offices_OfficeId] FOREIGN KEY ([OfficeId]) REFERENCES [Offices] ([Id]) ON DELETE CASCADE
);
GO

IF EXISTS (SELECT * FROM [sys].[identity_columns] WHERE [name] IN (N'Id', N'Address', N'Name') AND [object_id] = OBJECT_ID(N'[Offices]'))
    SET IDENTITY_INSERT [Offices] ON;
INSERT INTO [Offices] ([Id], [Address], [Name])
VALUES ('170ff47b-290a-4b22-acf7-8e265afeafb5', N'	876 Chicago Avenue', N'Lindsay'),
('5ab77607-42e8-4a25-b47a-db8983a652e8', N'1492 Brentwood Drive', N'Oscar'),
('7c862b39-c6d1-4c91-8181-c6cc35890bca', N'1477 Liberty Street', N'WASHINGTON'),
('99bc7e9d-9033-4752-a3db-a577447a7df3', N'1698 Brown Street d', N'Payson'),
('a228f20b-7458-4a8c-95ba-4b209965d677', N'1641 Granville Lane', N'Newark'),
('ca2abc8e-1bdc-4887-8f97-215fe050f22f', N'3406 Thrash Trail', N'Maud'),
('d097a599-4619-4473-ae86-d353c3069597', N'784 Byers Lanet', N'Redding');
IF EXISTS (SELECT * FROM [sys].[identity_columns] WHERE [name] IN (N'Id', N'Address', N'Name') AND [object_id] = OBJECT_ID(N'[Offices]'))
    SET IDENTITY_INSERT [Offices] OFF;
GO

IF EXISTS (SELECT * FROM [sys].[identity_columns] WHERE [name] IN (N'Id', N'FullName', N'Hired', N'OfficeId', N'RoleInCompany', N'Salary') AND [object_id] = OBJECT_ID(N'[Employees]'))
    SET IDENTITY_INSERT [Employees] ON;
INSERT INTO [Employees] ([Id], [FullName], [Hired], [OfficeId], [RoleInCompany], [Salary])
VALUES ('217cfe3f-f278-4ce8-84de-d9d523ca3802', N'Diane E Perry', '2020-03-02T01:05:30.5900390+05:30', 'd097a599-4619-4473-ae86-d353c3069597', N'Sellman', 100000.0),
('270ed53a-053b-442a-9302-716959d0a51a', N'Kristi C Mauricio', '2020-03-02T01:05:30.5900313+05:30', '5ab77607-42e8-4a25-b47a-db8983a652e8', N'Credit officer', 200000.0),
('3675f42d-9bbb-488f-bd36-c7e6411c87d5', N'Crystal F Krupa', '2020-03-02T01:05:30.5900307+05:30', '5ab77607-42e8-4a25-b47a-db8983a652e8', N'Developer', 420000.0),
('4fa3169e-0779-45cc-9139-dc4ee92cbd5f', N'Colton R Minton', '2020-03-02T01:05:30.5900303+05:30', '5ab77607-42e8-4a25-b47a-db8983a652e8', N'Backend developer', 190000.0),
('532c9736-4fb6-4a4d-aa8f-e7a2d6a4ca49', N'Sarah R Crews', '2020-03-02T01:05:30.5900393+05:30', 'd097a599-4619-4473-ae86-d353c3069597', N'Sellman', 240000.0),
('5c0bd7ac-a87b-4e92-81bb-14de6fdc6808', N'Bart J Burgess', '2020-03-02T01:05:30.5900387+05:30', 'd097a599-4619-4473-ae86-d353c3069597', N'Credit officer', 250000.0),
('6978cc16-5f5a-4020-bb79-4cc4dcc36b72', N'Antonio P Summers', '2017-03-02T01:05:30.5900270+05:30', '5ab77607-42e8-4a25-b47a-db8983a652e8', N'Manager', 200000.0),
('8588c7bf-2bd4-436a-a1fc-9c790895b9d5', N'Rhonda R Macklin', '2020-03-02T01:05:30.5900377+05:30', 'ca2abc8e-1bdc-4887-8f97-215fe050f22f', N'Backend developer', 190000.0),
('85cbcd1f-8b72-4398-b2fe-b2776ab0be0f', N'Jessica R Gibbs', '2017-03-02T01:05:30.5900374+05:30', 'ca2abc8e-1bdc-4887-8f97-215fe050f22f', N'Manager', 200000.0),
('b1ee8f72-0cc0-4cd9-bcc6-11183cf24da8', N'Thomas D Spates', '2020-03-02T01:05:30.5900315+05:30', '7c862b39-c6d1-4c91-8181-c6cc35890bca', N'Sellman', 200000.0),
('c3f4100c-f746-467b-ab9e-4c16361a44af', N'Willie M Overton', '2017-03-02T01:05:30.5900380+05:30', 'ca2abc8e-1bdc-4887-8f97-215fe050f22f', N'Head Of Developers', 12500000.0),
('c5dceee6-ab09-42ab-bc30-cb0e91114b3d', N'Candy J Gilbert', '2020-03-02T01:05:30.5900370+05:30', '7c862b39-c6d1-4c91-8181-c6cc35890bca', N'Web developer', 500000.0),
('d11d3a8d-30b6-4b3a-ad9b-ab2141a2f6bb', N'Gary E Owens', '2020-03-02T01:05:30.5900384+05:30', 'd097a599-4619-4473-ae86-d353c3069597', N'Sellman', 100000.0),
('d447d3e9-82d3-4aba-80ae-223a6683f5c3', N'Pattie L Foster', '2020-03-02T01:05:30.5900318+05:30', '7c862b39-c6d1-4c91-8181-c6cc35890bca', N'Sellman', 400000.0),
('ea3a236e-fda4-4e3f-ae1d-3bd3a535a177', N'Caitlin J Nicholson', '2020-03-02T01:05:30.5900310+05:30', '5ab77607-42e8-4a25-b47a-db8983a652e8', N'Sellman', 100000.0),
('f3ad3974-0c05-4db0-bda0-dee18f00a291', N'Catherine J Easley', '2020-03-02T01:05:30.5900396+05:30', 'd097a599-4619-4473-ae86-d353c3069597', N'Web developer', 100000.0);
IF EXISTS (SELECT * FROM [sys].[identity_columns] WHERE [name] IN (N'Id', N'FullName', N'Hired', N'OfficeId', N'RoleInCompany', N'Salary') AND [object_id] = OBJECT_ID(N'[Employees]'))
    SET IDENTITY_INSERT [Employees] OFF;
GO

CREATE INDEX [IX_Employees_OfficeId] ON [Employees] ([OfficeId]);
GO

INSERT INTO [__EFMigrationsHistory] ([MigrationId], [ProductVersion])
VALUES (N'20220301193530_Intial', N'6.0.2');
GO

COMMIT;
GO

----------------------------------------------------------------------


We can add data to database by 

Update-Database -Verbose






