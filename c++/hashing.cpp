#include<stdio.h>
#include<stdlib.h>

struct node{
	int key;
	struct node *next;	
};

struct node *create();
int hash_function(int key);
void insertKey(int key);
void deleteKey(int key);
int searchKey(int key);
void print();

struct node *head[10];

int main(){

	for(int i=0;i<10;i++){
		head[i]=NULL;
	}
	
	while(true){
		
        int o=0;
        printf("\nSelect One Option:\n1. Insert\n2. Delete\n3. Search\n4. Print\nEnter Your Choice: ");
        scanf("%d",&o);
        switch(o){
            case 1://insert
                {
                printf("\nINSERT KEY: ");
                int key;
                scanf("%d",&key);
                insertKey(key);                
                }    
                break;
            case 2://delete
                {
                printf("\nDELETE KEY: ");
                int key;
                scanf("%d",&key);
                deleteKey(key);                
                }
                break;
			case 3://search
                {
                printf("\nSEARCH KEY: ");
                int key;
                scanf("%d",&key);
                searchKey(key);                
                }
                break;
            case 4://print
				print();
				break;
            default: printf("\n*********** Bye *************\n");
                exit(0);
                break;
                
        }       
	}
	
return 0;
}

struct node *create(){
	return (struct node *)malloc(sizeof(struct node));	
}

int hash_function(int key){
	return (key+5)%10;
}

void insertKey(int key){
	printf("\nBefore:");
	print();
	
	struct node *n;
	n=create();
	n->key=key;
	int slot=hash_function(key);
	n->next=head[slot];
	head[slot]=n;
	
	printf("\nAfter:");
	print();
}

void deleteKey(int key){
	if(searchKey(key)){
		printf("\nBefore:");
		print();
		int slot=hash_function(key);
		struct node *temp=head[slot],*prev=head[slot];
		while(temp){
			if(temp->key==key){
				if(head[slot]->next==NULL){
					head[slot]=NULL;
				}else if(head[slot]->key==key&&head[slot]->next!=NULL){
					head[slot]=head[slot]->next;
				}else{
					prev->next=temp->next;
				}
			break;
			}
			prev=temp;
			temp=temp->next;
		}
		printf("\nAfter:");
		print();
	}
}

int searchKey(int key){
	int slot=hash_function(key);
	struct node *temp=head[slot];
	while(temp){
		if(temp->key==key){
			printf("\nKey Found\n");
			return 1;
		}
		temp=temp->next;
	}
	printf("\nKey Not Found\n");
	return 0;	
}

void print(){	
	for(int i=0;i<10;i++){
		printf("\nSlot %d: ",i+1);
		struct node *temp=head[i];
		while(temp){
			printf("%d ",temp->key);
			temp=temp->next;
		}		
	}
	printf("\n");
}

