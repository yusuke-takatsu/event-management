# event-management

[![debug test](https://github.com/yusuke-takatsu/event-management/actions/workflows/debug_test.yml/badge.svg)](https://github.com/yusuke-takatsu/event-management/actions/workflows/debug_test.yml)

event-managementのAPIサーバーのリポジトリです。

## 環境

- PHP8.2
- Laravel 10

## 環境構築

下記の流れに従って、環境構築を行なってください。

#### clone

```
git clone git@github.com:yusuke-takatsu/event-management.git
```

#### install

```
make install
```

#### コンテナ作成
```
make up
```

#### Laravelコンテナへの接続
```
make shell
```


#### push 前にやること

下記コマンド実行し、コードがフォーマットされていることを確認

```
make format
```


※準備中
