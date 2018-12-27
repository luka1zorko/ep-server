<?php

require_once("db/item.php");
require_once("ViewHelper.php");
#require_once("forms/ItemsForm.php");

class ItemController {

    public static function index() {
        $rules = [
            "id" => [
                'filter' => FILTER_VALIDATE_INT,
                'options' => ['min_range' => 1]
            ]
        ];

        $data = filter_input_array(INPUT_GET, $rules);

        if ($data["id"]) {
            echo ViewHelper::render("view/item-detail.php", [
                "item" => item::get($data)
            ]);
        } else {
            echo ViewHelper::render("view/itemList.view.php", [
                "items" => item::getAll()
            ]);
        }
    }
    
    /*
    public static function add() {
        $form = new ItemsInsertForm("add_form");

        if ($form->validate()) {
            $id = item::insert($form->getValue());
            ViewHelper::redirect(BASE_URL . "items?id=" . $id);
        } else {
            echo ViewHelper::render("view/item-form.php", [
                "title" => "Add item",
                "form" => $form
            ]);
        }
    }
    */
    
    /*
    public static function edit() {
        $editForm = new BooksEditForm("edit_form");
        $deleteForm = new BooksDeleteForm("delete_form");

        if ($editForm->isSubmitted()) {
            if ($editForm->validate()) {
                $data = $editForm->getValue();
                BookDB::update($data);
                ViewHelper::redirect(BASE_URL . "books?id=" . $data["id"]);
            } else {
                echo ViewHelper::render("view/book-form.php", [
                    "title" => "Edit book",
                    "form" => $editForm,
                    "deleteForm" => $deleteForm
                ]);
            }
        } else {
            $rules = [
                "id" => [
                    'filter' => FILTER_VALIDATE_INT,
                    'options' => ['min_range' => 1]
                ]
            ];

            $data = filter_input_array(INPUT_GET, $rules);

            if ($data["id"]) {
                $book = BookDB::get($data);
                $dataSource = new HTML_QuickForm2_DataSource_Array($book);
                $editForm->addDataSource($dataSource);
                $deleteForm->addDataSource($dataSource);

                echo ViewHelper::render("view/book-form.php", [
                    "title" => "Edit book",
                    "form" => $editForm,
                    "deleteForm" => $deleteForm
                ]);
            } else {
                throw new InvalidArgumentException("editing nonexistent entry");
            }
        }
    }
    */
    
    /*
    public static function delete() {
        $form = new BooksDeleteForm("delete_form");
        $data = $form->getValue();

        if ($form->isSubmitted() && $form->validate()) {
            BookDB::delete($data);
            ViewHelper::redirect(BASE_URL . "books");
        } else {
            if (isset($data["id"])) {
                $url = BASE_URL . "books/edit?id=" . $data["id"];
            } else {
                $url = BASE_URL . "books";
            }

            ViewHelper::redirect($url);
        }
    }
    */
}